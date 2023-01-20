<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Rooms Type Details Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-igloo"></i> &nbsp; Room Details</h2>

        <div class="details">
            <div class="details-grid">
                <!-- Room Image -->
                <div class="details-left">
                    <img src="<?php echo URLROOT . '/images/' . $data['posts']->roomImage ?>" alt="Room Image" width="320px" height="250px">
                </div>
                <div class="details-right">

                    <!-- Room Type -->
                    <div class="details-flex">
                        <h5>Type:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->roomType); ?>
                    </div>

                    <!-- Room Size -->
                    <div class="details-flex">
                        <h5>Size:</h5>
                        <?php printf('<p>%s m²</p>', $data['posts']->roomSize); ?>
                    </div>

                    <!-- Room Bed -->
                    <div class="details-flex-column">
                        <h5>Bed:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->roomBed); ?>
                    </div>

                    <!-- Room Total -->
                    <div class="details-flex">
                        <h5>Total:</h5>
                        <?php printf('<p>%s Rooms</p>', $data['posts']->roomTotal_Of_Type); ?>
                    </div>

                    <!-- Room Price -->
                    <div class="details-flex">
                        <h5>Price:</h5>
                        <?php printf('<p>$%s</p>', $data['posts']->roomPrice); ?>
                    </div>
                </div>
            </div>

            <!-- Room Description -->
            <div class="details-desc">
                <?php printf('<p>%s</p>', $data['posts']->roomDescription); ?>
            </div>

            <div class="details-btns">
                <!-- Redirect to edit room page -->
                <a href="<?php echo URLROOT . '/hms/editRoom/' . $data['posts']->id; ?>" class="detail-btn btn-left">Edit</a>

                <!-- Delete room -->
                <a href="<?php echo URLROOT . '/hms/deleteRoom/' . $data['posts']->id; ?>" onclick="return confirm('Please confirm.')" class="detail-btn btn-right">Delete</a>
            </div>
        </div>
    </div>
</section>
<!-- End of Rooms Type Details Page -->


<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>