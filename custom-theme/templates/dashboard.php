<?php
/*
Template Name: Dashboard
*/
get_header();
?>
 <div class="dashboard">
    <!-- Header Section -->
    <section class="header-section">
        <img src="path-to-logo" alt="Company Logo">
    </section>

    <!-- Basic Information Section -->
    <section class="basic-info">
        <h2>Basic Information</h2>
        <div class="grid">
            <a href="#"><img src="icon1.png" alt="Icon"> Company Motto</a>
            <a href="#"><img src="icon2.png" alt="Icon"> SD Goals</a>
            <!-- Repeat for each link in this section -->
        </div>
    </section>

    <!-- Business Systems Section -->
    <section class="business-systems">
        <h2>Business Systems</h2>
        <div class="grid">
            <a href="#"><img src="icon3.png" alt="Icon"> Approval</a>
            <a href="#"><img src="icon4.png" alt="Icon"> Mail/Schedule</a>
            <!-- Repeat for each link in this section -->
        </div>
    </section>

    <!-- Company Notifications Section -->
    <section class="notifications">
        <h2>Company Notifications</h2>
        <div class="notification-slider">
            <!-- Add a slider here if needed for rotating notifications -->
        </div>
    </section>

    <!-- Forms & Manuals Section -->
    <section class="forms-manuals">
        <h2>Forms & Manuals</h2>
        <div class="grid">
            <a href="#"><img src="icon5.png" alt="Icon"> Application Forms</a>
            <a href="#"><img src="icon6.png" alt="Icon"> Compliance</a>
            <!-- Repeat for each link in this section -->
        </div>
    </section>
</div>

<?php get_footer(); ?>
