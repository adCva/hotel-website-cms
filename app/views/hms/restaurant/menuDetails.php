<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Menu Item Details Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-utensils"></i> &nbsp; Menu Item Details</h2>

        <div class="details">
            <div class="details-grid">
                <!-- Menu Item Image -->
                <div class="details-left">
                    <img src="<?php echo URLROOT . '/images/' . $data['posts']->img ?>" alt="Menu Image" width="320px" height="250px">
                </div>
                <div class="details-right">

                    <!-- Menu Item Name -->
                    <div class="details-flex">
                        <h5>Name:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->name); ?>
                    </div>

                    <!-- Menu Item Price -->
                    <div class="details-flex">
                        <h5>Price:</h5>
                        <?php printf('<p>$ %s</p>', $data['posts']->price); ?>
                    </div>

                </div>
            </div>

            <!-- Menu Item Description -->
            <div class="details-desc">
                <?php printf('<p>%s</p>', $data['posts']->description); ?>
            </div>

            <!-- Menu Item Ingredients -->
            <div class="details-desc">
                <?php printf('<p>%s</p>', $data['posts']->ingredients); ?>
            </div>

            <div class="details-btns">
                <!-- Redirect to edit menu item page -->
                <a href="<?php echo URLROOT . '/hms/editMenuItem/' . $data['posts']->id; ?>" class="detail-btn btn-left">Edit</a>

                <!-- Archive menu item -->
                <form action="<?php echo URLROOT . '/hms/menuDetails/' . $data['posts']->id; ?>" method="POST" class="details-btn-form">
                    <input type="submit" name="archiveMenu" value="Archive" class='detail-btn btn-right'>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Menu Item Details Page -->


<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>