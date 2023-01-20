<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Event Details Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="far fa-calendar"></i> &nbsp; Restaurant Event Details</h2>

        <div class="details">
            <div class="details-grid">
                <!-- Event Image -->
                <div class="details-left">
                    <img src="<?php echo URLROOT . '/images/' . $data['posts']->img ?>" alt="Event Image" width="320px" height="250px">
                </div>
                <div class="details-right">

                    <!-- Event Name -->
                    <div class="details-flex">
                        <h5>Name:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->name); ?>
                    </div>

                    <!-- Event Day -->
                    <div class="details-flex">
                        <h5>Day:</h5>
                        <?php
                        $day = date_create($data['posts']->day);
                        printf('<p>%s</p>', date_format($day, 'M d, Y'));
                        ?>
                    </div>

                    <!-- Event Price -->
                    <div class="details-flex">
                        <h5>Price:</h5>
                        <?php printf('<p>$ %s</p>', $data['posts']->price); ?>
                    </div>

                </div>
            </div>

            <!-- Event Details -->
            <div class="details-desc">
                <?php printf('<p>%s</p>', $data['posts']->details); ?>
            </div>

            <div class="details-btns">
                <!-- Redirect to edit rest event page -->
                <a href="<?php echo URLROOT . '/hms/editRestEvent/' . $data['posts']->id; ?>" class="detail-btn btn-left">Edit</a>

                <!-- Archive rest event -->
                <form action="<?php echo URLROOT . '/hms/eventsRestDetails/' . $data['posts']->id; ?>" method="POST" class="details-btn-form">
                    <input type="submit" name="archiveRestEvent" value="Archive" class='detail-btn btn-right'>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Event Details Page -->


<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>