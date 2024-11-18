<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="site-wrapper">

<header class="site-header">
    <div class="header-container">
        <!-- Logo Section -->
        <div class="header-logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo" class="logo-image">
            </a>
        </div>

        <!-- Search Bar Section -->
        <div class="header-search">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>

<?php
// Rest of your theme template files (like content or navigation) will follow here
?>
<style>
  /* Header Container */
.site-header {
    padding: 10px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

/* Logo */
.header-logo {
    flex: 0 0 auto; /* Prevents logo section from shrinking */
}

.logo-image {
    width: 100px;
    height: 100px;
    object-fit: cover; /* Ensures the image is centered within the 100x100 box */
}

/* Search Bar */
.header-search {
    flex: 1;
    display: flex;
    justify-content: flex-end;
}

.search-form {
    position: relative;
}

.search-field {
    width: 300px; /* Adjust width as needed */
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px 0 0 4px;
    font-size: 16px;
}

.search-submit {
    padding: 8px 15px;
    background-color: #005f8a;
    color: white;
    border: none;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
}

.search-submit:hover {
    background-color: #004466;
}

  </style>