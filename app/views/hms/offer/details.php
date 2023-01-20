<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Offer Details Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-coins"></i> &nbsp; Offer Details</h2>

        <div class="details">
            <div class="details-grid">
                <!-- Offer Image -->
                <div class="details-left">
                    <img src="<?php echo URLROOT . '/images/' . $data['posts']->offerImage; ?>" alt="Room Image" width="320px" height="250px">
                </div>
                <div class="details-right">
                    <!-- Offer Name -->
                    <div class="details-flex-column">
                        <?php printf('<p>%s</p>', $data['posts']->offerName); ?>
                    </div>

                    <!-- Offer Start -->
                    <div class="details-flex">
                        <h5>Start:</h5>
                        <?php
                        $start = date_create($data['posts']->offerStart);
                        printf('<p>%s</p>', date_format($start, 'M d, Y'));
                        ?>
                    </div>

                    <!-- Offer End -->
                    <div class="details-flex">
                        <h5>End:</h5>
                        <?php
                        $end = date_create($data['posts']->offerEnd);
                        printf('<p>%s</p>', date_format($end, 'M d, Y'));
                        ?>
                    </div>

                    <!-- Offer Price -->
                    <div class="details-flex">
                        <h5>Price:</h5>
                        <?php printf('<p>$ %s</p>', $data['posts']->offerPrice); ?>
                    </div>
                </div>

            </div>

            <!-- Offer Description -->
            <div class="details-desc">
                <?php printf('<p>%s</p>', $data['posts']->offerDescription); ?>
            </div>

            <div class="details-btns">
                <!-- Redirect to edit offer -->
                <td><a href="<?php echo URLROOT . '/hms/editOffer/' . $data['posts']->id; ?>" class="detail-btn btn-left">Edit</a></td>

                <!-- Archive offer -->
                <form action="<?php echo URLROOT . '/hms/offerDetail/' . $data['posts']->id; ?>" method="POST" class="details-btn-form">
                    <input type="submit" name="archive" value="Archive" class='detail-btn btn-right'>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End of Offer Details Page -->


<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>