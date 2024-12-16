<?php
/**
 * Template Name: Create New Content Info (Enhanced UI)
 */

get_header();

?>
<style>
 .create-new-content-info-form {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.create-new-content-info-form p {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.create-new-content-info-form label {
    flex: 0 0 150px; /* Fixed width for labels */
    margin-right: 10px;
    font-weight: bold;
    font-size: 14px;
}

.create-new-content-info-form input,
.create-new-content-info-form textarea,
.create-new-content-info-form select,
.create-new-content-info-form button {
    flex: 1; /* Take up the remaining space */
    font-size: 14px;
    padding: 8px;
    margin: 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.create-new-content-info-form textarea {
    resize: vertical;
}

.create-new-content-info-form button {
    background-color: #0073aa;
    color: #fff;
    border: none;
    cursor: pointer;
    padding: 10px 20px;
    font-size: 16px;
    text-align: center;
    border-radius: 4px;
}

.create-new-content-info-form button:hover {
    background-color: #005177;
}

.success-message {
    color: green;
    font-weight: bold;
    margin-bottom: 15px;
}

.error-message {
    color: red;
    font-weight: bold;
    margin-bottom: 15px;
}

input[type="file"] {
    padding: 3px; /* Adjust padding for better alignment */
}

/* Rich text editor styling */
.wp-editor-container {
    flex: 1;
    margin: 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    overflow: hidden;
}


  </style>
<?php

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_new_content_info_nonce'])) {
  if (wp_verify_nonce($_POST['create_new_content_info_nonce'], 'create_new_content_info')) {
      // Retrieve form data
      $title = sanitize_text_field($_POST['new_content_info_title']);
      $department = sanitize_text_field($_POST['new_content_info_department']);
      $preview_text = wp_kses_post($_POST['new_content_info_preview_text']);
      $text = wp_kses_post($_POST['new_content_info_text']);
      $category = isset($_POST['new_content_info_category']) ? intval($_POST['new_content_info_category']) : 0;
      $expiration_date = sanitize_text_field($_POST['new_content_info_expiration_date']);
      $sort_order = intval($_POST['new_content_info_sort_order']);
      $folder = isset($_POST['new_content_info_folder']) ? intval($_POST['new_content_info_folder']) : 0;

      // Validate required fields
      if (!empty($title) && !empty($department)) {
          // Create the post
          $new_post = [
              'post_title' => $title,
              'post_type' => 'content_new_info',
              'post_status' => 'publish', // Change to 'draft' if review is needed
          ];

          $post_id = wp_insert_post($new_post);

          if (!is_wp_error($post_id)) {
              // Assign taxonomy terms
              if ($category) {
                  wp_set_post_terms($post_id, [$category], 'content_category');
              }

              // Save custom meta fields
              update_post_meta($post_id, '_department_name', $department);
              update_post_meta($post_id, '_preview_text', $preview_text);
              update_post_meta($post_id, '_text', $text);
              update_post_meta($post_id, '_expiration_date', $expiration_date);
              update_post_meta($post_id, '_sort_order', $sort_order);

              // Save folder meta
              if ($folder) {
                  update_post_meta($post_id, '_folder_id', $folder);
              }

              // Handle file uploads
              if (!empty($_FILES['new_content_info_files']['name'][0])) {
                  $uploaded_files = [];
                  foreach ($_FILES['new_content_info_files']['name'] as $key => $file_name) {
                      $file_tmp = $_FILES['new_content_info_files']['tmp_name'][$key];
                      $file_type = $_FILES['new_content_info_files']['type'][$key];
                      $upload = wp_handle_upload([
                          'name' => $file_name,
                          'tmp_name' => $file_tmp,
                          'type' => $file_type,
                          'size' => $_FILES['new_content_info_files']['size'][$key],
                      ], ['test_form' => false]);

                      if (!isset($upload['error'])) {
                          $uploaded_files[] = $upload['url'];
                      }
                  }

                  if (!empty($uploaded_files)) {
                      update_post_meta($post_id, '_attached_files', $uploaded_files);
                  }
              }

              echo '<p class="success-message">New Content Info created successfully!</p>';
          } else {
              echo '<p class="error-message">Failed to create New Content Info. Please try again.</p>';
          }
      } else {
          echo '<p class="error-message">Title and Department are required!</p>';
      }
  } else {
      echo '<p class="error-message">Nonce verification failed!</p>';
  }
}
?>

<div class="create-new-content-info-form">
    <form method="post" action="" enctype="multipart/form-data">
        <?php wp_nonce_field('create_new_content_info', 'create_new_content_info_nonce'); ?>

        <p>
            <label for="new_content_info_title">Title <span class="required">*</span></label>
            <input type="text" id="new_content_info_title" name="new_content_info_title" required style="width: 100%;">
        </p>

        <p>
            <label for="new_content_info_department">Department <span class="required">*</span></label>
            <input type="text" id="new_content_info_department" name="new_content_info_department" required style="width: 100%;">
        </p>

        <p>
            <label for="new_content_info_preview_text">Preview Text</label>
            <textarea id="new_content_info_preview_text" name="new_content_info_preview_text" rows="4" style="width: 100%;"></textarea>
        </p>

        <p>
            <label for="new_content_info_text">Text</label>
            <?php wp_editor('', 'new_content_info_text', ['textarea_name' => 'new_content_info_text']); ?>
        </p>

        <p>
            <label for="new_content_info_category">Category</label>
            <select id="new_content_info_category" name="new_content_info_category" style="width: 100%;">
                <option value=""><?php _e('Select Category', 'your-text-domain'); ?></option>
                <?php
                $categories = get_terms([
                    'taxonomy' => 'content_category',
                    'hide_empty' => false,
                ]);
                foreach ($categories as $category) {
                    echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <label for="new_content_info_expiration_date">Expiration Date</label>
            <input type="date" id="new_content_info_expiration_date" name="new_content_info_expiration_date" style="width: 100%;">
        </p>

        <p>
            <label for="new_content_info_sort_order">Sort Order</label>
            <input type="number" id="new_content_info_sort_order" name="new_content_info_sort_order" style="width: 100px;">
        </p>

        <p>
            <label for="new_content_info_folder">Folder</label>
            <select id="new_content_info_folder" name="new_content_info_folder" style="width: 100%;">
                <option value=""><?php _e('Select Folder', 'your-text-domain'); ?></option>
                <?php
                $folders = get_pages([
                    'post_type' => 'folder',
                    'parent' => 0,
                    'sort_column' => 'menu_order',
                ]);
                foreach ($folders as $folder) {
                    echo '<option value="' . esc_attr($folder->ID) . '">' . esc_html($folder->post_title) . '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <label for="new_content_info_files">Attach Files</label>
            <input type="file" id="new_content_info_files" name="new_content_info_files[]" multiple>
        </p>

        <p>
            <button type="submit"><?php _e('Create New Content Info', 'your-text-domain'); ?></button>
        </p>
    </form>
</div>

<?php get_footer(); ?>
