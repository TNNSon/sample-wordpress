<?php
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
if (have_posts()) :
    while (have_posts()) : the_post();
        echo '<h1>' . get_the_title() . '</h1>';
        
        // Table for Contents related to this Folder
        $folder_id = get_the_ID();

        // Query for Content items belonging to this Folder
        $content_args = [
            'post_type' => 'content',
            'meta_query' => [
                [
                    'key' => '_related_folder_id', // assuming this meta field stores the folder id
                    'value' => $folder_id,
                    'compare' => '='
                ]
            ],
            'orderby' => 'title',
            'order' => 'ASC'
        ];
        $contents = new WP_Query($content_args);

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
                echo '<td>' . get_the_title() . '</td>';
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
            echo '<p>No content items found for this folder.</p>';
        }

        wp_reset_postdata(); // Reset query for global scope
    endwhile;
else :
    echo '<p>Folder not found.</p>';
endif;

get_footer();
