<?php
get_header();
?>
<style>
  .folder-icon {
    font-size: 16px;
    margin-right: 5px;
    color: #0073aa;
}

  .folder-details-container {
    padding: 20px;
}

.folder-content-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.folder-content-table th,
.folder-content-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.folder-content-table th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.folder-content-table tr:hover {
    background-color: #f9f9f9;
}

.folder-icon {
    font-size: 16px;
    margin-right: 5px;
    color: #0073aa;
}

.action-link {
    color: #0073aa;
    text-decoration: none;
}

.action-link:hover {
    text-decoration: underline;
}
</style>
<?php
// Get the current content post ID
$current_post_id = get_queried_object_id();

// Get the related folder ID from the post meta
$related_folder_id = get_queried_object_id();
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
} else {
  echo esc_html('aaa');
}
?>

<div class="single-content-container">
    <h1><?php the_title(); ?></h1>

    <table class="folder-content-table">
        <thead>
            <tr>
                <th><?php _e('Title', 'your-text-domain'); ?></th>
                <th><?php _e('Last Updated', 'your-text-domain'); ?></th>
                <th><?php _e('Actions', 'your-text-domain'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display sub-folders
            if ($sub_folders->have_posts()) :
                while ($sub_folders->have_posts()) :
                    $sub_folders->the_post();
                    ?>
                    <tr>
                        <td>
                            <a href="<?php the_permalink(); ?>">
                                <span class="folder-icon dashicons dashicons-category"></span>
                                <?php the_title(); ?>
                            </a>
                        </td>
                        <td><?php echo get_the_modified_date(); ?></td>
                        <td>
                            <a href="<?php the_permalink(); ?>" class="action-link"><?php _e('View', 'your-text-domain'); ?></a>
                        </td>
                    </tr>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;

            // Display related content posts
            if ($related_posts->have_posts()) :
                while ($related_posts->have_posts()) :
                    $related_posts->the_post();
                    ?>
                    <tr>
                        <td>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </td>
                        <td><?php echo get_the_modified_date(); ?></td>
                        <td>
                            <a href="<?php the_permalink(); ?>" class="action-link"><?php _e('View', 'your-text-domain'); ?></a>
                        </td>
                    </tr>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php
get_footer();
