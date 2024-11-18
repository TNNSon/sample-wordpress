<?php
/* Template Name: Custom Login Page */
get_header();
?>

<div class="custom-login-page">
    <h1>Login to Your Account</h1>

    <?php
    // Display login errors, if any
    if ( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) {
        echo '<p class="login-error">Invalid login credentials. Please try again.</p>';
    } elseif ( isset( $_GET['login'] ) && $_GET['login'] == 'empty' ) {
        echo '<p class="login-error">Please enter both your username and password.</p>';
    } elseif ( isset( $_GET['login'] ) && $_GET['login'] == 'false' ) {
        echo '<p class="login-error">You are logged out.</p>';
    }
    ?>

    <div class="login-form">
        <?php
        // Display the login form with a redirect to the homepage
        wp_login_form( array(
            'redirect' => home_url( '/dashboard/' ), // Replace with the URL you want users to go to after login
            'form_id' => 'custom-login-form',
            'label_username' => 'Username',
            'label_password' => 'Password',
            'label_remember' => 'Remember Me',
            'label_log_in' => 'Login',
            'remember' => true
        ) );
        ?>
    </div>

    <p class="custom-register-link">Don't have an account? <a href="<?php echo wp_registration_url(); ?>">Register here</a>.</p>
</div>

<?php get_footer(); ?>
