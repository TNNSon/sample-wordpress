<?php
/* Template Name: Content List */

get_header();
?>
<style>

.button.folder-list-button {
    background-color: #0073aa;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
    display: inline-block;
    margin-bottom: 20px;
}

.button.folder-list-button:hover {
    background-color: #005f8a;
}

.content-list {
    width: 100%;
    border-collapse: collapse;
}

.content-list th, .content-list td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.content-list th {
    background-color: #f4f4f4;
    font-weight: bold;
}

  </style>

<?php
// Display the button to redirect to the Folder list
echo '<a href="' . site_url('/folder') . '" class="button folder-list-button">Folder List</a>';

// Query for all Content items
$args = [
    'post_type' => 'content',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
];
$contents = new WP_Query($args);

if ($contents->have_posts()) {
    echo '<table class="content-list">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Title</th>';
    echo '<th>Department</th>';
    echo '<th>Category</th>';
    echo '<th>Publication Period</th>';
    echo '<th>Document Classification</th>';
    echo '<th>In-House Deployment</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($contents->have_posts()) {
        $contents->the_post();

        echo '<tr>';
        echo '<td><a href="' . get_permalink() . '">' . get_the_title() . '</a></td>';
        echo '<td>' . esc_html(get_post_meta(get_the_ID(), '_department_name', true)) . '</td>';
        echo '<td>' . esc_html(get_post_meta(get_the_ID(), '_category', true)) . '</td>';
        echo '<td>' . esc_html(get_post_meta(get_the_ID(), '_publication_period', true)) . '</td>';
        echo '<td>' . esc_html(get_post_meta(get_the_ID(), '_document_classification', true)) . '</td>';
        echo '<td>' . esc_html(get_post_meta(get_the_ID(), '_in_house_deployment', true)) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No content items found.</p>';
}

wp_reset_postdata();
get_footer();
