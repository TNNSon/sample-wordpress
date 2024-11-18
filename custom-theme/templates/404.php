<?php
/*
Template Name: 404
*/
get_header(); ?>

<div class="container">
  <div class="section header">
    <h1><?php _e('Page Not Found', 'your-theme-text-domain'); ?></h1>
  </div>
  
  <div class="section">
    <p><?php _e('Sorry, the page you are looking for could not be found.', 'your-theme-text-domain'); ?></p>
    <p><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Return to Homepage', 'your-theme-text-domain'); ?></a></p>
  </div>
  
  <!-- Optional: Include a search form -->
  <div class="section">
    <?php get_search_form(); ?>
  </div>
</div>

<?php get_footer(); ?>
