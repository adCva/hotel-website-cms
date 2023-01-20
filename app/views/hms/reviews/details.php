<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Review Details Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-see-message"><i class="fas fa-graduation-cap"></i> &nbsp; Review Details</h2>

        <div class="details">
            <!-- Review from -->
            <div class="details-flex">
                <h5>Client:</h5>
                <?php printf('<p>%s</p>', $data['posts']->fromClient); ?>
            </div>

            <!-- Review email -->
            <div class="details-flex">
                <h5>Email:</h5>
                <?php printf('<p>%s</p>', $data['posts']->clientEmail); ?>
            </div>

            <!-- Review from date -->
            <div class="details-flex">
                <h5>Created:</h5>
                <?php
                $created = date_create($data['posts']->created);
                printf('<p>%s</p>', date_format($created, 'M d, Y'));
                ?>
            </div>

            <!-- Review status -->
            <div class="details-flex">
                <h5>Status:</h5>
                <?php printf('<p>%s</p>', $data['posts']->status); ?>
            </div>

            <!-- Review description -->
            <div class="details-desc">
                <?php printf('<p>%s</p>', $data['posts']->description); ?>
            </div>

            <div class="details-btns">
                <?php if ($data['posts']->status == 'hidden') : ?>
                    <a href="<?php echo URLROOT . '/hms/reviewStatus/' . $data['posts']->id; ?>/active" class="detail-btn btn-left">Make Active</a>
                <?php else : ?>
                    <a href="<?php echo URLROOT . '/hms/reviewStatus/' . $data['posts']->id; ?>/hidden" class="detail-btn btn-left">Hide Review</a>
                <?php endif; ?>
                <form action="<?php echo URLROOT . '/hms/reviewDetail/' . $data['posts']->id; ?>" method="POST" class="details-btn-form">
                    <input type="submit" name="archiveReview" value="Archive" class='detail-btn btn-right'>
                </form>
            </div>

        </div>
    </div>
</section>
<!-- End of Review Details Page -->

<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>