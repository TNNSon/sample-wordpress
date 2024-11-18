</div> <!-- Close site-wrapper -->
<footer class="site-footer">
    <div class="footer-container">
        <!-- Copyright Text -->
        <div class="footer-copyright">
            <p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<style>
 /* Make the site wrapper a flex container to control layout */
html, body {
   display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.site-wrapper {
  flex: 1;
    display: flex;
    flex-direction: column;
}

/* Main content area takes up the remaining space */
.site-content {
    flex: 1;
}

/* Footer */
.site-footer {
    background-color: #333; /* Footer background color */
    color: #fff; /* Footer text color */
    padding: 20px 0;
    text-align: center;
}


</style>
</body>
</html>
