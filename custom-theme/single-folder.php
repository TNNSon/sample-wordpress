<?php
get_header();

// Get the current content post ID
$current_post_id = get_the_ID();

// Get the related folder ID from the post meta
$related_folder_id = get_the_ID();
echo esc_html($related_folder_id);
// Fetch related folder, sub-folders, and other content posts
if ($related_folder_id) {
    // Query related folder details
    $related_folder = get_post($related_folder_id);

    // Query sub-folders under the related folder
    $sub_folders = new WP_Query([
        'post_type' => 'folder',
        'post_parent' => $related_folder_id, // Fetch sub-folders of the related folder
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ]);

    // Query other content posts in the same folder
    $related_posts = new WP_Query([
        'post_type' => 'content',
        'meta_query' => [
            [
                'key' => '_related_folder_id',
                'value' => $related_folder_id,
                'compare' => '=',
            ],
        ],
        'post__not_in' => [$current_post_id], // Exclude the current content post
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
}
?>

<div class="single-content-container">
    <h1><?php the_title(); ?></h1>

    <div class="content-main">
        <?php
        // Display the main content
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>

    <?php if ($related_folder_id && $related_folder) : ?>
        <div class="related-folder">
            <h2><?php _e('Related Folder', 'your-text-domain'); ?></h2>
            <a href="<?php echo get_permalink($related_folder_id); ?>" class="folder-link">
                <span class="folder-icon dashicons dashicons-category"></span>
                <span class="folder-title"><?php echo esc_html($related_folder->post_title); ?></span>
            </a>
        </div>
    <?php endif; ?>

    <?php if ($sub_folders->have_posts()) : ?>
        <div class="sub-folders">
            <h2><?php _e('Sub-Folders', 'your-text-domain'); ?></h2>
            <ul class="folder-list-grid">
                <?php while ($sub_folders->have_posts()) : $sub_folders->the_post(); ?>
                    <li class="folder-item">
                        <a href="<?php the_permalink(); ?>" class="folder-link">
                            <span class="folder-icon dashicons dashicons-category"></span>
                            <span class="folder-title"><?php the_title(); ?></span>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>

    <?php if ($related_posts->have_posts()) : ?>
        <div class="related-posts">
            <h2><?php _e('Related Posts', 'your-text-domain'); ?></h2>
            <ul class="related-posts-list">
                <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                    <li class="related-post-item">
                        <a href="<?php the_permalink(); ?>" class="related-post-link"><?php the_title(); ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</div>

<?php
get_footer();
