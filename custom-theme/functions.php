<?php
// require login in all wordpress pages
function require_login_for_site() {
  if ( !is_user_logged_in() && !is_page('login') ) {
      wp_redirect( wp_login_url() );
      exit;
  }
}
add_action( 'template_redirect', 'require_login_for_site' );

// prevent user is admin to wp-admin route
// function restrict_wp_admin_access() {
//   if ( is_admin() && ! current_user_can( 'administrator' ) && ! wp_doing_ajax() ) {
//       wp_redirect( home_url() ); // Redirect to the homepage (or any other URL)
//       exit;
//   }
// }
// add_action( 'admin_init', 'restrict_wp_admin_access' );

function redirect_to_custom_login_page() {
  // Check if the user is trying to access wp-login.php and is not logged in
   // Log the current request URI to the PHP error log
   error_log( "Request URI: " . $_SERVER['REQUEST_URI'] );
  if ( $_SERVER['REQUEST_URI'] == '/wp-login.php' && ! is_user_logged_in() ) {
      wp_redirect( home_url( '/login' ) ); // Replace '/login/' with the slug of your custom login page
  }
  // Check if the user is trying to access wp-admin directly and is not logged in
  elseif ( is_admin() && ! is_user_logged_in() ) {
      wp_redirect( home_url( '/login' ) );
  }
}
add_action( 'init', 'redirect_to_custom_login_page' );



// redirect users after login based on role
function custom_login_redirect( $redirect_to, $request, $user ) {
    // Check if the user has specific roles
    error_log( "Request URI: " . $_SERVER['REQUEST_URI'] );
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'administrator', $user->roles ) ) {
            return admin_url(); // Redirect administrators to the dashboard
        } else {
            return home_url( '/custom-dashboard/' ); // Redirect other users to a specific page
        }
    } else {
        return $redirect_to; // Default redirect if no specific criteria are met 
    }
}
add_filter( 'login_redirect', 'custom_login_redirect', 10, 3 );


// function custom_login_failed_redirect( $username ) {
//   wp_redirect( home_url( '/login/?login=failed' ) ); // Redirect to custom login page with error parameter
//   exit;
// }
// add_action( 'wp_login_failed', 'custom_login_failed_redirect' );

// function custom_login_empty_redirect( $user, $username, $password ) {
//   if ( empty( $username ) || empty( $password ) ) {
//       wp_redirect( home_url( '/login/?login=empty' ) ); // Redirect to custom login page with empty error parameter
//       exit;
//   }
// }
// add_filter( 'authenticate', 'custom_login_empty_redirect', 30, 3 );

// function custom_logout_redirect() {
//   wp_redirect( home_url( '/login/?login=false' ) ); // Redirect to custom login page after logout
//   exit;
// }
// add_action( 'wp_logout', 'custom_logout_redirect' );

/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );

function custom_login_enqueue_styles() {
    if ( is_page_template( 'templates/page-login.php' ) ) {
        wp_enqueue_style( 'custom-login-style', get_template_directory_uri() . '/assets/css/login-style.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'custom_login_enqueue_styles' );

function custom_dashboard_styles() {
  wp_enqueue_style('dashboard-style', get_template_directory_uri() . '/assets/css/dashboard.css');
}
add_action('wp_enqueue_scripts', 'custom_dashboard_styles');

function add_font_awesome() {
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'add_font_awesome');


// add_action('init','custom_login');
// function custom_login(){
//  global $pagenow;
//  if( 'wp-login.php' == $pagenow ) {
//   wp_redirect( home_url( '/login/' ));
//  }
// }


function custom_login_failed_redirect() {
    $login_page = home_url( '/login/' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'custom_login_failed_redirect' );




// function create_movie_post_type() {
//   $labels = array(
//       'name'               => 'Movies',
//       'singular_name'      => 'Movie',
//       'menu_name'          => 'Movies',
//       'name_admin_bar'     => 'Movie',
//       'add_new'            => 'Add New',
//       'add_new_item'       => 'Add New Movie',
//       'new_item'           => 'New Movie',
//       'edit_item'          => 'Edit Movie',
//       'view_item'          => 'View Movie',
//       'all_items'          => 'All Movies',
//       'search_items'       => 'Search Movies',
//       'parent_item_colon'  => 'Parent Movies:',
//       'not_found'          => 'No movies found.',
//       'not_found_in_trash' => 'No movies found in Trash.'
//   );

//   $args = array(
//       'labels'             => $labels,
//       'public'             => true,
//       'publicly_queryable' => true,
//       'show_ui'            => true,
//       'show_in_menu'       => true,
//       'query_var'          => true,
//       'rewrite'            => array( 'slug' => 'movies' ),
//       'capability_type'    => 'post',
//       'has_archive'        => true,
//       'hierarchical'       => false,
//       'menu_position'      => 5,
//       'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
//   );

//   register_post_type( 'movie', $args );
// }
// add_action( 'init', 'create_movie_post_type' );
// function movie_add_meta_boxes() {
//   add_meta_box(
//       'movie_details',
//       'Movie Details',
//       'movie_render_meta_box',
//       'movie',
//       'normal',
//       'high'
//   );
// }
// add_action( 'add_meta_boxes', 'movie_add_meta_boxes' );

// function movie_render_meta_box( $post ) {
//   // Render fields for Genre, Director, Release Date, Rating, etc.
//   // Example field: Genre
//   $genre = get_post_meta( $post->ID, '_movie_genre', true );
//   echo '<label for="movie_genre">Genre:</label>';
//   echo '<input type="text" id="movie_genre" name="movie_genre" value="' . esc_attr( $genre ) . '" />';
//   // Repeat similar fields for other details
// }

// function movie_save_meta_boxes( $post_id ) {
//   if ( array_key_exists( 'movie_genre', $_POST ) ) {
//       update_post_meta( $post_id, '_movie_genre', $_POST['movie_genre'] );
//   }
//   // Save other fields similarly
// }
// add_action( 'save_post', 'movie_save_meta_boxes' );

// function custom_post_types() {
//   // Folder Post Type (for Admins)
//   // Register Folder Post Type with a unique slug (e.g., 'folder_item')
//   register_post_type( 'folder_item', array(
//     'labels' => array(
//         'name'          => 'Folders',
//         'singular_name' => 'Folder',
//         'add_new_item'  => 'Add New Folder',
//         'edit_item'     => 'Edit Folder',
//         'new_item'      => 'New Folder',
//         'view_item'     => 'View Folder',
//         'search_items'  => 'Search Folders',
//     ),
//     'public'        => true,
//     'has_archive'   => true,
//     'show_in_menu'  => true,
//     'rewrite'       => array( 'slug' => 'folder-item' ), // Unique slug to avoid conflicts
//     'capability_type' => 'folder',
//     'map_meta_cap' => true,
//     'supports'      => array( 'title' ),
// ));

//   // Content Post Type (for Managers and Users)
//   register_post_type( 'content', array(
//       'labels' => array(
//           'name' => 'Content',
//           'singular_name' => 'Content',
//       ),
//       'public' => true,
//       'has_archive' => false,
//       'show_in_menu' => true,
//       'capability_type' => 'content',
//       'map_meta_cap' => true,
//       'supports' => array( 'title', 'editor' ),
//   ));
// }
// add_action( 'init', 'custom_post_types' );

// function setup_custom_roles_and_caps() {
//   // Ensure the Manager role exists; create it if not
//   if ( ! get_role( 'manager' ) ) {
//       add_role( 'manager', 'Manager', array( 'read' => true ) );
//   }

//   // Ensure the User role exists; create it if not
//   if ( ! get_role( 'user' ) ) {
//       add_role( 'user', 'User', array( 'read' => true ) );
//   }

//   // Assign capabilities to each role
//   $admin_role = get_role( 'administrator' );
//   $manager_role = get_role( 'manager' );
//   $user_role = get_role( 'user' );

//   // Capabilities for Folder (Admin only)
//   $folder_caps = array(
//       'edit_folder',
//       'edit_folders',
//       'publish_folders',
//       'delete_folder',
//       'delete_folders',
//   );

//   foreach ( $folder_caps as $cap ) {
//       $admin_role->add_cap( $cap );
//   }

//   // Capabilities for Content (Managers and Admins)
//   $content_caps = array(
//       'edit_content',
//       'edit_contents',
//       'publish_contents',
//       'delete_content',
//       'delete_contents',
//       'edit_others_contents',
//   );

//   foreach ( $content_caps as $cap ) {
//       $admin_role->add_cap( $cap );
//       $manager_role->add_cap( $cap );
//   }

//   // Viewing capability for Users
//   $user_role->add_cap( 'read' );
// }
// add_action( 'admin_init', 'setup_custom_roles_and_caps' );

// function create_folder_taxonomy() {
//   register_taxonomy(
//       'folder_item',         // Taxonomy name (slug)
//       'content',        // Post type(s) this taxonomy applies to
//       array(
//           'labels' => array(
//               'name'              => 'Folders',
//               'singular_name'     => 'Folder',
//               'search_items'      => 'Search Folders',
//               'all_items'         => 'All Folders',
//               'parent_item'       => 'Parent Folder',
//               'parent_item_colon' => 'Parent Folder:',
//               'edit_item'         => 'Edit Folder',
//               'update_item'       => 'Update Folder',
//               'add_new_item'      => 'Add New Folder',
//               'new_item_name'     => 'New Folder Name',
//               'menu_name'         => 'Folders',
//           ),
//           'hierarchical' => true,           // Set to true to make it behave like categories
//           'show_ui'      => true,           // Display in the admin menu
//           'show_admin_column' => true,      // Show as a column in the admin post list
//           'rewrite'      => array( 'slug' => 'folder_item' ), // URL slug for this taxonomy
//       )
//   );
// }
// add_action( 'init', 'create_folder_taxonomy' );


// add load style.css
function custom_theme_styles() {
  // Enqueue the main stylesheet
  wp_enqueue_style('custom-theme-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'custom_theme_styles');


// function register_custom_post_types_and_taxonomy() {
//     // Register Folder Item Post Type (Parent)
//     register_post_type( 'folder_item', array(
//         'labels' => array(
//             'name'          => 'Folders',
//             'singular_name' => 'Folder',
//             'add_new_item'  => 'Add New Folder',
//             'edit_item'     => 'Edit Folder',
//             'new_item'      => 'New Folder',
//             'view_item'     => 'View Folder',
//             'search_items'  => 'Search Folders',
//         ),
//         'public'        => true,
//         'has_archive'   => true,
//         'show_in_menu'  => true,
//         'rewrite'       => array( 'slug' => 'folder-item' ),
//         'capability_type' => 'folder_item',
//         'map_meta_cap' => true,
//         'supports'      => array( 'title' ),
//     ));

//     // Register Content Post Type (Child)
//     register_post_type( 'content', array(
//         'labels' => array(
//             'name'          => 'Content',
//             'singular_name' => 'Content',
//             'add_new_item'  => 'Add New Content',
//             'edit_item'     => 'Edit Content',
//             'new_item'      => 'New Content',
//             'view_item'     => 'View Content',
//             'search_items'  => 'Search Content',
//         ),
//         'public'        => true,
//         'has_archive'   => false,
//         'show_in_menu'  => true,
//         'rewrite'       => array( 'slug' => 'content' ),
//         'capability_type' => 'content',
//         'map_meta_cap' => true,
//         'supports'      => array( 'title', 'editor' ),
//     ));

//     // Register a Custom Taxonomy to Link Content to Folder Item
//     register_taxonomy(
//         'folder',           // Taxonomy slug
//         'content',          // Applies to the 'content' post type
//         array(
//             'labels' => array(
//                 'name'              => 'Folders',
//                 'singular_name'     => 'Folder',
//                 'search_items'      => 'Search Folders',
//                 'all_items'         => 'All Folders',
//                 'edit_item'         => 'Edit Folder',
//                 'update_item'       => 'Update Folder',
//                 'add_new_item'      => 'Add New Folder',
//                 'new_item_name'     => 'New Folder Name',
//                 'menu_name'         => 'Folders',
//             ),
//             'hierarchical' => true,           // Like categories
//             'show_ui'      => true,           // Show in the admin UI
//             'show_admin_column' => true,      // Show in the admin post list
//             'rewrite'      => array( 'slug' => 'folder' ),
//         )
//     );
// }
// add_action( 'init', 'register_custom_post_types_and_taxonomy' );
// Add Folder column to Content admin list
// function add_folder_column_to_content( $columns ) {
//   $columns['folder'] = 'Folder';
//   return $columns;
// }
// add_filter( 'manage_content_posts_columns', 'add_folder_column_to_content' );

// // Display Folder name in the custom column
// function display_folder_column_content( $column, $post_id ) {
//   if ( 'folder' === $column ) {
//       // Get the folder terms for this content post
//       $terms = get_the_terms( $post_id, 'folder' );

//       if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
//           $term = array_shift( $terms );
//           $folder_link = add_query_arg( array( 'post_type' => 'content', 'folder' => $term->term_id ), admin_url( 'edit.php' ) );
//           echo '<a href="' . esc_url( $folder_link ) . '">' . esc_html( $term->name ) . '</a>';
//       } else {
//           echo 'No Folder';
//       }
//   }
// }
// add_action( 'manage_content_posts_custom_column', 'display_folder_column_content', 10, 2 );


// function custom_content_list_rewrite_rule() {
//   add_rewrite_rule(
//       '^content-list/([0-9]+)/?$',
//       'index.php?pagename=content-list&folder_id=$matches[1]',
//       'top'
//   );
// }
// add_action( 'init', 'custom_content_list_rewrite_rule' );

// function add_folder_id_query_var( $vars ) {
//   $vars[] = 'folder_id';
//   return $vars;
// }
// add_filter( 'query_vars', 'add_folder_id_query_var' );


// function register_movie_and_review_post_types() {
//   register_post_type('movie', [
//       'label' => 'Movies',
//       'public' => true,
//       'supports' => ['title', 'editor', 'thumbnail'],
//   ]);

//   register_post_type('review', [
//       'label' => 'Reviews',
//       'public' => true,
//       'supports' => ['title', 'editor'],
//   ]);
// }

// add_action('init', 'register_movie_and_review_post_types');


// function add_movie_meta_box() {
//   add_meta_box(
//       'related_movie', // ID of the meta box
//       'Related Movie', // Title of the meta box
//       'movie_meta_box_callback', // Callback function
//       'review', // Post type
//       'side', // Context (e.g., 'normal', 'side')
//       'default' // Priority
//   );
// }

// add_action('add_meta_boxes', 'add_movie_meta_box');


// function movie_meta_box_callback($post) {
//   // Get the current value, if any
//   $selected_movie = get_post_meta($post->ID, '_related_movie_id', true);
  
//   // Retrieve all movies to populate the dropdown
//   $movies = get_posts(['post_type' => 'movie', 'numberposts' => -1]);

//   echo '<label for="related_movie_field">Select a related movie:</label>';
//   echo '<select name="related_movie_field" id="related_movie_field" style="width: 100%;">';
//   echo '<option value="">None</option>';

//   foreach ($movies as $movie) {
//       echo '<option value="' . $movie->ID . '" ' . selected($selected_movie, $movie->ID, false) . '>' . $movie->post_title . '</option>';
//   }

//   echo '</select>';
// }


// function save_related_movie_meta($post_id) {
//   // Check if our custom field is set
//   if (isset($_POST['related_movie_field'])) {
//       // Save the data, sanitize it as an integer
//       update_post_meta($post_id, '_related_movie_id', intval($_POST['related_movie_field']));
//   }
// }

// add_action('save_post', 'save_related_movie_meta');

// function create_movie_taxonomy() {
//   register_taxonomy(
//       'movie_category', // Taxonomy slug
//       'movie', // Post type to apply this taxonomy to
//       [
//           'label' => 'Movie Categories',
//           'rewrite' => ['slug' => 'movie-category'],
//           'hierarchical' => true, // True to make it like categories, false for tags
//       ]
//   );
// }

// add_action('init', 'create_movie_taxonomy');



function register_folder_and_content_post_types() {
  // Register Folder post type
  register_post_type('folder', [
      'label' => 'Folders',
      'public' => true,
      'supports' => ['title'],
  ]);

  // Register Content post type
  register_post_type('content', [
      'label' => 'Contents',
      'public' => true,
      'supports' => ['title', 'editor'],
  ]);
}

add_action('init', 'register_folder_and_content_post_types');

function add_content_meta_boxes() {
  add_meta_box(
      'content_details', // ID
      'Content Details', // Title
      'content_meta_box_callback', // Callback function
      'content', // Post type
      'normal', // Context
      'high' // Priority
  );
}

add_action('add_meta_boxes', 'add_content_meta_boxes');

function content_meta_box_callback($post) {
  // Add a nonce field for security
  wp_nonce_field('save_content_details', 'content_details_nonce');
  
  // Retrieve existing values (if any)
  $department_name = get_post_meta($post->ID, '_department_name', true);
  $category = get_post_meta($post->ID, '_category', true);
  $publication_period = get_post_meta($post->ID, '_publication_period', true);
  $document_classification = get_post_meta($post->ID, '_document_classification', true);
  $in_house_deployment = get_post_meta($post->ID, '_in_house_deployment', true);

  // Department Name
  echo '<label for="department_name">Department Name (required):</label>';
  echo '<input type="text" id="department_name" name="department_name" value="' . esc_attr($department_name) . '" required style="width: 100%;"><br><br>';

  // Category
  echo '<label for="category">Category:</label>';
  echo '<select id="category" name="category" style="width: 100%;">';
  echo '<option value="test1"' . selected($category, 'test1', false) . '>Test1</option>';
  echo '<option value="test2"' . selected($category, 'test2', false) . '>Test2</option>';
  echo '<option value="test3"' . selected($category, 'test3', false) . '>Test3</option>';
  echo '</select><br><br>';

  // Publication Period (Date Picker)
  echo '<label for="publication_period">Publication Period:</label>';
  echo '<input type="date" id="publication_period" name="publication_period" value="' . esc_attr($publication_period) . '" style="width: 100%;"><br><br>';

  // Document Classification
  echo '<label for="document_classification">Document Classification:</label>';
  echo '<select id="document_classification" name="document_classification" style="width: 100%;">';
  echo '<option value="doc1"' . selected($document_classification, 'doc1', false) . '>Doc1</option>';
  echo '<option value="doc2"' . selected($document_classification, 'doc2', false) . '>Doc2</option>';
  echo '<option value="doc3"' . selected($document_classification, 'doc3', false) . '>Doc3</option>';
  echo '</select><br><br>';

  // In-House Deployment
  echo '<label for="in_house_deployment">In-House Deployment:</label>';
  echo '<select id="in_house_deployment" name="in_house_deployment" style="width: 100%;">';
  echo '<option value="display"' . selected($in_house_deployment, 'display', false) . '>Display</option>';
  echo '<option value="hidden"' . selected($in_house_deployment, 'hidden', false) . '>Hidden</option>';
  echo '<option value="all"' . selected($in_house_deployment, 'all', false) . '>All</option>';
  echo '</select>';
}


function save_content_details($post_id) {
  // Verify nonce for security
  if (!isset($_POST['content_details_nonce']) || !wp_verify_nonce($_POST['content_details_nonce'], 'save_content_details')) {
      return;
  }

  // Save Department Name
  if (isset($_POST['department_name'])) {
      update_post_meta($post_id, '_department_name', sanitize_text_field($_POST['department_name']));
  }

  // Save Category
  if (isset($_POST['category'])) {
      update_post_meta($post_id, '_category', sanitize_text_field($_POST['category']));
  }

  // Save Publication Period
  if (isset($_POST['publication_period'])) {
      update_post_meta($post_id, '_publication_period', sanitize_text_field($_POST['publication_period']));
  }

  // Save Document Classification
  if (isset($_POST['document_classification'])) {
      update_post_meta($post_id, '_document_classification', sanitize_text_field($_POST['document_classification']));
  }

  // Save In-House Deployment
  if (isset($_POST['in_house_deployment'])) {
      update_post_meta($post_id, '_in_house_deployment', sanitize_text_field($_POST['in_house_deployment']));
  }
}

add_action('save_post', 'save_content_details');

// add related Content with Folder
function add_folder_meta_box_to_content() {
  add_meta_box(
      'related_folder', // ID of the meta box
      'Related Folder', // Title of the meta box
      'folder_meta_box_callback', // Callback function to display the dropdown
      'content', // Post type
      'side', // Context (where it appears: normal, side, etc.)
      'default' // Priority
  );
}

add_action('add_meta_boxes', 'add_folder_meta_box_to_content');

function folder_meta_box_callback($post) {
  // Get the selected folder ID if it exists
  $selected_folder = get_post_meta($post->ID, '_related_folder_id', true);
  
  // Fetch all Folder posts
  $folders = get_posts([
      'post_type' => 'folder',
      'numberposts' => -1,
  ]);

  echo '<label for="related_folder_field">Select a related folder:</label>';
  echo '<select name="related_folder_field" id="related_folder_field" style="width: 100%;">';
  echo '<option value="">None</option>'; // Default option if no folder is selected

  foreach ($folders as $folder) {
      echo '<option value="' . $folder->ID . '" ' . selected($selected_folder, $folder->ID, false) . '>' . $folder->post_title . '</option>';
  }

  echo '</select>';
}

function save_related_folder_meta($post_id) {
  // Check if our custom field is set
  if (isset($_POST['related_folder_field'])) {
      // Save the data, sanitize it as an integer
      update_post_meta($post_id, '_related_folder_id', intval($_POST['related_folder_field']));
  }
}

add_action('save_post', 'save_related_folder_meta');



// Add meta boxes to the Folder post type
function add_folder_permission_meta_boxes() {
  add_meta_box(
      'folder_permissions',
      'Folder Permissions',
      'render_folder_permissions_meta_box',
      'folder', // Post type slug for Folder
      'side',
      'high'
  );
}
add_action('add_meta_boxes', 'add_folder_permission_meta_boxes');

// Render the meta box
function render_folder_permissions_meta_box($post) {
  // Get current values
  $selected_users = get_post_meta($post->ID, '_folder_access_users', true) ?: [];
  $selected_roles = get_post_meta($post->ID, '_folder_access_roles', true) ?: [];

  // Get all users
  $users = get_users(['fields' => ['ID', 'display_name']]);
  echo '<p><strong>Select Users:</strong></p>';
  echo '<select multiple name="folder_access_users[]" style="width:100%;">';
  foreach ($users as $user) {
      $selected = in_array($user->ID, $selected_users) ? 'selected' : '';
      echo '<option value="' . esc_attr($user->ID) . '" ' . $selected . '>' . esc_html($user->display_name) . '</option>';
  }
  echo '</select>';

  // Get all roles
  $roles = wp_roles()->roles;
  echo '<p><strong>Select Roles:</strong></p>';
  echo '<select multiple name="folder_access_roles[]" style="width:100%;">';
  foreach ($roles as $role_key => $role) {
      $selected = in_array($role_key, $selected_roles) ? 'selected' : '';
      echo '<option value="' . esc_attr($role_key) . '" ' . $selected . '>' . esc_html($role['name']) . '</option>';
  }
  echo '</select>';
}

// Save meta box data
function save_folder_permission_meta_data($post_id) {
  if (isset($_POST['folder_access_users'])) {
      update_post_meta($post_id, '_folder_access_users', array_map('sanitize_text_field', $_POST['folder_access_users']));
  } else {
      delete_post_meta($post_id, '_folder_access_users');
  }

  if (isset($_POST['folder_access_roles'])) {
      update_post_meta($post_id, '_folder_access_roles', array_map('sanitize_text_field', $_POST['folder_access_roles']));
  } else {
      delete_post_meta($post_id, '_folder_access_roles');
  }
}
add_action('save_post_folder', 'save_folder_permission_meta_data');

?>
