<?php
/* Template Name: Folder List */

get_header();
?>
<style>
  .folder-list, .content-list {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.folder-list th, .folder-list td,
.content-list th, .content-list td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.folder-list th, .content-list th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.folder-list td a, .content-list td a {
    text-decoration: none;
    color: #0073aa;
}

.folder-list td a:hover, .content-list td a:hover {
    text-decoration: underline;
}

  </style>
  <?php
// Query for all Folders
$args = [
    'post_type' => 'folder',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
];
$folders = new WP_Query($args);

if ($folders->have_posts()) {
    echo '<table class="folder-list">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Title</th>';
    echo '<th>Updated Date</th>';
    echo '<th>Published Date</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($folders->have_posts()) {
        $folders->the_post();
        
        echo '<tr>';
        echo '<td><a href="' . get_permalink() . '">' . get_the_title() . '</a></td>';
        echo '<td>' . get_the_modified_date() . '</td>';
        echo '<td>' . get_the_date() . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No folders found.</p>';
}

wp_reset_postdata();
get_footer();
