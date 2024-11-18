<?php
/*
 * Plugin Name: Custom LDAPS Login
 * Description: Provides LDAPS-based authentication for WordPress login.
 * Version: 1.0
 * Author: Your Name
 * License: GPL2
 */

// Define default LDAP settings
define('DEFAULT_LDAP_SERVER', 'ldaps://ldap.example.com');
define('DEFAULT_LDAP_PORT', 636);
define('DEFAULT_LDAP_BASE_DN', 'dc=example,dc=com');
define('DEFAULT_LDAP_USER_DN', 'cn=users,dc=example,dc=com');

// Add a settings page in the WordPress admin menu
add_action('admin_menu', 'custom_ldaps_login_add_admin_menu');
function custom_ldaps_login_add_admin_menu() {
    add_options_page(
        'LDAPS Login Settings',           // Page title
        'LDAPS Login',                    // Menu title
        'manage_options',                 // Capability required to access
        'custom-ldaps-login',             // Menu slug
        'custom_ldaps_login_settings_page' // Callback function
    );
}
function custom_ldap_test_connection($username, $password) {
  // Retrieve LDAP settings from plugin options
  $options = get_option('custom_ldaps_login_options');
  $ldap_server = $options['ldap_server'] ?? DEFAULT_LDAP_SERVER;
  $ldap_port = $options['ldap_port'] ?? DEFAULT_LDAP_PORT;
  $ldap_user_dn = $options['ldap_user_dn'] ?? DEFAULT_LDAP_USER_DN;

  // Connect to LDAP server
  $ldap_connection = ldap_connect($ldap_server, $ldap_port);
  ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);

  if (!$ldap_connection) {
      return new WP_Error('ldap_connection_failed', __('Failed to connect to LDAP server.'));
  }

  // Attempt to bind with the provided username and password
  $bind_dn = "uid={$username}," . $ldap_user_dn;
  $ldap_bind = @ldap_bind($ldap_connection, $bind_dn, $password);

  // Close the connection
  ldap_unbind($ldap_connection);

  // Return the result
  if ($ldap_bind) {
      return true; // Connection successful
  } else {
      return new WP_Error('ldap_auth_failed', __('LDAP authentication failed. Please check the credentials.'));
  }
}

// Create the settings page HTML
function custom_ldaps_login_settings_page() {
  ?>
  <div class="wrap">
      <h1>LDAPS Login Settings</h1>
      <form method="post" action="options.php">
          <?php
          settings_fields('custom_ldaps_login_settings'); // Settings group
          do_settings_sections('custom-ldaps-login');     // Page slug
          submit_button();                               // Save settings button
          ?>
      </form>
      <hr>
      <h2>Test LDAP Connection</h2>
      <form method="post">
          <label for="test_username">Username:</label>
          <input type="text" id="test_username" name="test_username" required />
          <label for="test_password">Password:</label>
          <input type="password" id="test_password" name="test_password" required />
          <?php submit_button('Test Connection'); ?>
      </form>
  </div>
  <?php

  // Handle the test connection if form submitted
  if (isset($_POST['test_username']) && isset($_POST['test_password'])) {
      $test_result = custom_ldap_test_connection(sanitize_text_field($_POST['test_username']), sanitize_text_field($_POST['test_password']));
      
      if (is_wp_error($test_result)) {
          echo '<div class="notice notice-error"><p>' . esc_html($test_result->get_error_message()) . '</p></div>';
      } else {
          echo '<div class="notice notice-success"><p>LDAP connection and authentication successful!</p></div>';
      }
  }
}

// Register settings and fields
add_action('admin_init', 'custom_ldaps_login_settings_init');
// Add the role selection field to the settings page
function custom_ldaps_login_settings_init() {
  register_setting('custom_ldaps_login_settings', 'custom_ldaps_login_options');

  add_settings_section(
      'custom_ldaps_login_section',
      'LDAP Configuration',
      'custom_ldaps_login_section_callback',
      'custom-ldaps-login'
  );

  add_settings_field(
      'ldap_server',
      'LDAP Server',
      'custom_ldaps_login_text_field_callback',
      'custom-ldaps-login',
      'custom_ldaps_login_section',
      ['label_for' => 'ldap_server']
  );

  add_settings_field(
      'ldap_port',
      'LDAP Port',
      'custom_ldaps_login_text_field_callback',
      'custom-ldaps-login',
      'custom_ldaps_login_section',
      ['label_for' => 'ldap_port']
  );

  add_settings_field(
      'ldap_base_dn',
      'Base DN',
      'custom_ldaps_login_text_field_callback',
      'custom-ldaps-login',
      'custom_ldaps_login_section',
      ['label_for' => 'ldap_base_dn']
  );

  add_settings_field(
      'ldap_user_dn',
      'User DN',
      'custom_ldaps_login_text_field_callback',
      'custom-ldaps-login',
      'custom_ldaps_login_section',
      ['label_for' => 'ldap_user_dn']
  );

  // Add a new field for selecting the default role
  add_settings_field(
      'default_user_role',
      'Default User Role',
      'custom_ldaps_login_role_field_callback',
      'custom-ldaps-login',
      'custom_ldaps_login_section'
  );
}

// Callback for the role selection dropdown
function custom_ldaps_login_role_field_callback() {
  $options = get_option('custom_ldaps_login_options');
  $selected_role = $options['default_user_role'] ?? 'subscriber';
  
  // Get all WordPress roles
  $roles = wp_roles()->roles;

  echo '<select id="default_user_role" name="custom_ldaps_login_options[default_user_role]">';
  foreach ($roles as $role_key => $role) {
      $selected = ($selected_role == $role_key) ? 'selected="selected"' : '';
      echo '<option value="' . esc_attr($role_key) . '" ' . $selected . '>' . esc_html($role['name']) . '</option>';
  }
  echo '</select>';
}


function custom_ldaps_login_section_callback() {
    echo '<p>Enter your LDAP server details below:</p>';
}

function custom_ldaps_login_text_field_callback($args) {
    $options = get_option('custom_ldaps_login_options');
    $value = $options[$args['label_for']] ?? '';
    echo '<input type="text" id="' . esc_attr($args['label_for']) . '" name="custom_ldaps_login_options[' . esc_attr($args['label_for']) . ']" value="' . esc_attr($value) . '" />';
}

// Function to connect and authenticate with LDAPS
function custom_ldap_authenticate($username, $password) {
  $options = get_option('custom_ldaps_login_options');
  $ldap_server = $options['ldap_server'] ?? DEFAULT_LDAP_SERVER;
  $ldap_port = $options['ldap_port'] ?? DEFAULT_LDAP_PORT;
  $ldap_base_dn = $options['ldap_base_dn'] ?? DEFAULT_LDAP_BASE_DN;
  $ldap_user_dn = $options['ldap_user_dn'] ?? DEFAULT_LDAP_USER_DN;

  $ldap_connection = ldap_connect($ldap_server, $ldap_port);
  ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);

  if (!$ldap_connection) {
      return false;
  }

  // Bind with user's DN and password
  $bind_dn = "uid={$username}," . $ldap_user_dn;
  $ldap_bind = @ldap_bind($ldap_connection, $bind_dn, $password);

  return $ldap_bind ? $ldap_connection : false;
}

// WordPress login integration
function custom_ldap_login($username, $password) {
  $ldap_connection = custom_ldap_authenticate($username, $password);

  if ($ldap_connection) {
      $user = get_user_by('login', $username);

      if (!$user) {
          // Auto-create a WordPress user if it doesn’t exist
          $user_id = wp_create_user($username, $password, "{$username}@example.com");
          $user = get_user_by('id', $user_id);
      }

      wp_set_current_user($user->ID);
      wp_set_auth_cookie($user->ID);
      do_action('wp_login', $username);

      return true;
  } else {
      return false; // Authentication failed
  }
}

// Hook into WordPress login
add_action('wp_authenticate', 'custom_ldap_login', 10, 2);
