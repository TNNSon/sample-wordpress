<?php
/* Template Name: Create Content */
get_header();
?>

<div class="create-content-page">
    <h1>Create New Content</h1>
    <?php
// Define roles and permissions
$roles = [
    'admin' => [
        'create_folder' => true,
        'delete_folder' => true,
        'view_content' => true,
        'edit_content' => true,
    ],
    'manager' => [
        'create_folder' => false,
        'delete_folder' => false,
        'view_content' => true,
        'edit_content' => true,
    ],
    'user' => [
        'create_folder' => false,
        'delete_folder' => false,
        'view_content' => true,
        'edit_content' => false,
    ],
];

// Define current user's role
$currentUserRole = 'manager'; // Example, replace with actual role management logic

echo "<h1>User Roles and Permissions</h1>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Role</th><th>Permissions</th></tr>";

// Display all roles and permissions
foreach ($roles as $roleName => $permissions) {
    echo "<tr>";
    echo "<td><strong>" . ucfirst($roleName) . "</strong></td>";
    echo "<td>";
    foreach ($permissions as $permission => $allowed) {
        echo ucfirst(str_replace('_', ' ', $permission)) . ": " . ($allowed ? "Yes" : "No") . "<br>";
    }
    echo "</td>";
    echo "</tr>";
}

// Display current user's role and permissions
echo "<tr style='background-color: #f0f0f0;'>";
echo "<td><strong>Current User Role: " . ucfirst($currentUserRole) . "</strong></td>";
echo "<td>";
foreach ($roles[$currentUserRole] as $permission => $allowed) {
    echo ucfirst(str_replace('_', ' ', $permission)) . ": " . ($allowed ? "Yes" : "No") . "<br>";
}
echo "</td>";
echo "</tr>";

echo "</table>";
?>


    <?php
    // Check if the user has the correct capability (in this case, 'edit_content' for Managers)
    if ( current_user_can('edit_contents') ) :

        // Handle form submission
        if ( isset( $_POST['content_title'] ) && isset( $_POST['content_body'] ) ) {
            // Verify the nonce
            if ( ! isset( $_POST['content_nonce'] ) || ! wp_verify_nonce( $_POST['content_nonce'], 'submit_content' ) ) {
                echo '<p class="error">Invalid form submission.</p>';
            } else {
                // Sanitize user input
                $content_title = sanitize_text_field( $_POST['content_title'] );
                $content_body = sanitize_textarea_field( $_POST['content_body'] );
                $selected_folder = isset( $_POST['content_folder'] ) ? (int) $_POST['content_folder'] : 0;

                // Insert the new content post
                $new_post = array(
                    'post_title'   => $content_title,
                    'post_content' => $content_body,
                    'post_status'  => 'publish',
                    'post_type'    => 'content',
                    'tax_input'    => array( 'folder_item' => array( $selected_folder ) ),
                );

                $post_id = wp_insert_post( $new_post );

                if ( $post_id ) {
                    echo '<p class="success">Content created successfully!</p>';
                } else {
                    echo '<p class="error">There was an error creating the content. Please try again.</p>';
                }
            }
        }
    ?>

    <!-- Display the content creation form -->
    <form method="POST" action="">
        <label for="content_title">Title:</label>
        <input type="text" id="content_title" name="content_title" required>

        <label for="content_body">Content:</label>
        <textarea id="content_body" name="content_body" rows="6" required></textarea>
        <label for="content_folder">Select Folder:</label>
<select id="content_folder" name="content_folder">
    <?php
    // Fetch and list all available folders
    $folders = get_terms( array(
        'taxonomy'   => 'folder_item',
        'hide_empty' => false,
    ));

    if ( !empty($folders) && !is_wp_error($folders) ) {
        foreach ( $folders as $folder ) {
            echo '<option value="' . esc_attr( $folder->term_id ) . '">' . esc_html( $folder->name ) . '</option>';
        }
    } else {
        echo '<option value="">No folders available</option>';
    }
    ?>
</select>


        <?php wp_nonce_field( 'submit_content', 'content_nonce' ); ?>
        <input type="submit" value="Create Content">
    </form>

    <?php
    else :
        echo '<p>You do not have permission to create content.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
