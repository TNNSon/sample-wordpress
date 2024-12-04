<?php
function register_content_taxonomies() {
  // Register Content Category
  register_taxonomy(
      'content_category',
      'content',
      [
          'labels' => [
              'name' => 'Categories',
              'singular_name' => 'Category',
              'menu_name' => 'Content Categories',
              'all_items' => 'All Categories',
              'edit_item' => 'Edit Category',
              'view_item' => 'View Category',
              'add_new_item' => 'Add New Category',
              'search_items' => 'Search Categories',
              'not_found' => 'No categories found',
          ],
          'hierarchical' => true,
          'public' => true,
          'show_ui' => true,
          'show_in_rest' => true,
          'rewrite' => ['slug' => 'content-category'],
      ]
  );

  // Register Content Classify
  register_taxonomy(
      'content_classify',
      'content',
      [
          'labels' => [
              'name' => 'Classifications',
              'singular_name' => 'Classification',
              'menu_name' => 'Content Classifications',
              'all_items' => 'All Classifications',
              'edit_item' => 'Edit Classification',
              'view_item' => 'View Classification',
              'add_new_item' => 'Add New Classification',
              'search_items' => 'Search Classifications',
              'not_found' => 'No classifications found',
          ],
          'hierarchical' => true,
          'public' => true,
          'show_ui' => true,
          'show_in_rest' => true,
          'rewrite' => ['slug' => 'content-classify'],
      ]
  );
}
add_action('init', 'register_content_taxonomies');

function set_taxonomies_to_single_selection() {
  // Enqueue script only on the Content post type edit screen
  global $typenow;

  if ($typenow === 'content') {
      ?>
      <script>
          jQuery(document).ready(function ($) {
              // Convert checkboxes for Categories to a dropdown
              const categoryDiv = $('#content_categorydiv');
              categoryDiv.find('input[type="checkbox"]').each(function () {
                  $(this).attr('type', 'radio'); // Convert checkboxes to radio buttons
              });

              // Convert checkboxes for Classify to a dropdown
              const classifyDiv = $('#content_classifydiv');
              classifyDiv.find('input[type="checkbox"]').each(function () {
                  $(this).attr('type', 'radio'); // Convert checkboxes to radio buttons
              });
          });
      </script>
      <?php
  }
}
add_action('admin_footer', 'set_taxonomies_to_single_selection');

function add_content_columns($columns) {
  $columns['content_category'] = __('Category', 'your-text-domain');
  $columns['content_classify'] = __('Classification', 'your-text-domain');
  return $columns;
}
add_filter('manage_content_posts_columns', 'add_content_columns');

function display_content_columns($column, $post_id) {
  if ($column === 'content_category') {
      $terms = get_the_terms($post_id, 'content_category');
      echo !empty($terms) && !is_wp_error($terms) ? esc_html($terms[0]->name) : '—';
  }

  if ($column === 'content_classify') {
      $terms = get_the_terms($post_id, 'content_classify');
      echo !empty($terms) && !is_wp_error($terms) ? esc_html($terms[0]->name) : '—';
  }
}
add_action('manage_content_posts_custom_column', 'display_content_columns', 10, 2);

function add_content_filters() {
  global $typenow;

  if ($typenow === 'content') {
      // Filter by Category
      $category_taxonomy = 'content_category';
      $categories = get_terms([
          'taxonomy' => $category_taxonomy,
          'hide_empty' => false,
      ]);

      if (!empty($categories)) {
          echo '<select name="content_category" id="content_category" class="postform">';
          echo '<option value="">' . __('All Categories', 'your-text-domain') . '</option>';
          foreach ($categories as $category) {
              $selected = (isset($_GET['content_category']) && $_GET['content_category'] === $category->slug) ? ' selected="selected"' : '';
              echo '<option value="' . esc_attr($category->slug) . '"' . $selected . '>' . esc_html($category->name) . '</option>';
          }
          echo '</select>';
      }

      // Filter by Classification
      $classify_taxonomy = 'content_classify';
      $classifications = get_terms([
          'taxonomy' => $classify_taxonomy,
          'hide_empty' => false,
      ]);

      if (!empty($classifications)) {
          echo '<select name="content_classify" id="content_classify" class="postform">';
          echo '<option value="">' . __('All Classifications', 'your-text-domain') . '</option>';
          foreach ($classifications as $classification) {
              $selected = (isset($_GET['content_classify']) && $_GET['content_classify'] === $classification->slug) ? ' selected="selected"' : '';
              echo '<option value="' . esc_attr($classification->slug) . '"' . $selected . '>' . esc_html($classification->name) . '</option>';
          }
          echo '</select>';
      }
  }
}
add_action('restrict_manage_posts', 'add_content_filters');

function filter_content_by_taxonomies($query) {
  global $pagenow, $typenow;

  if ($pagenow === 'edit.php' && $typenow === 'content') {
      // Filter by Category
      if (!empty($_GET['content_category'])) {
          $query->query_vars['tax_query'][] = [
              'taxonomy' => 'content_category',
              'field' => 'slug',
              'terms' => sanitize_text_field($_GET['content_category']),
          ];
      }

      // Filter by Classification
      if (!empty($_GET['content_classify'])) {
          $query->query_vars['tax_query'][] = [
              'taxonomy' => 'content_classify',
              'field' => 'slug',
              'terms' => sanitize_text_field($_GET['content_classify']),
          ];
      }
  }
}
add_action('pre_get_posts', 'filter_content_by_taxonomies');
function add_folder_column_to_content($columns) {
  // Insert the Folder column after the Title column
  $columns = array_slice($columns, 0, 2, true) +
      ['folder' => __('Folder', 'your-text-domain')] +
      array_slice($columns, 2, null, true);

  return $columns;
}
add_filter('manage_content_posts_columns', 'add_folder_column_to_content');
function display_folder_column_in_content($column, $post_id) {
  if ($column === 'folder') {
      // Retrieve the folder ID from the post meta
      $folder_id = get_post_meta($post_id, '_related_folder_id', true);

      if ($folder_id) {
          // Get the folder post object
          $folder = get_post($folder_id);

          if ($folder) {
              // Display folder name with a link to edit the folder
              echo '<a href="' . get_edit_post_link($folder_id) . '">' . esc_html($folder->post_title) . '</a>';
          } else {
              echo __('Folder not found', 'your-text-domain');
          }
      } else {
          echo __('No folder assigned', 'your-text-domain');
      }
  }
}
add_action('manage_content_posts_custom_column', 'display_folder_column_in_content', 10, 2);
function make_folder_column_sortable($sortable_columns) {
  $sortable_columns['folder'] = 'folder';
  return $sortable_columns;
}
add_filter('manage_edit-content_sortable_columns', 'make_folder_column_sortable');

function sort_content_by_folder($query) {
  if (!is_admin() || !$query->is_main_query()) {
      return;
  }

  if ($query->get('orderby') === 'folder') {
      $query->set('meta_key', '_related_folder_id'); // Meta key for folder
      $query->set('orderby', 'meta_value'); // Order by meta value
  }
}
add_action('pre_get_posts', 'sort_content_by_folder');
