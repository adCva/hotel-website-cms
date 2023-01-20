<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Hotel Booking Details Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-hotel"></i> &nbsp; Reservation Details</h2>

        <div class="details">
            <div class="details-grid">
                <div class="details-left">
                    <!-- Room Type Selected -->
                    <div class="details-flex">
                        <h5>Room Type:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->roomType); ?>
                    </div>

                    <!-- Name -->
                    <div class="details-flex">
                        <h5>Name:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->clientName); ?>
                    </div>

                    <!-- Adults -->
                    <div class="details-flex">
                        <h5>Adults:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->adultsNr); ?>
                    </div>

                    <!-- Kids -->
                    <div class="details-flex">
                        <h5>Kids:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->kidsNr); ?>
                    </div>

                    <!-- Total Rooms -->
                    <div class="details-flex">
                        <h5>Total Rooms:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->totalRooms); ?>
                    </div>
                </div>

                <div class="details-right">
                    <!-- Phone -->
                    <div class="details-flex">
                        <h5>Phone:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->clientPhone); ?>
                    </div>

                    <!-- Email -->
                    <div class="details-flex">
                        <h5>Email:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->clientEmail); ?>
                    </div>

                    <!-- Created -->
                    <div class="details-flex">
                        <h5>Created:</h5>
                        <?php
                        $created = date_create($data['posts']->created);
                        printf('<p>%s</p>', date_format($created, 'M d, Y'));
                        ?>
                    </div>

                    <!-- Starting -->
                    <div class="details-flex">
                        <h5>Starting:</h5>
                        <?php
                        $starting = date_create($data['posts']->startAt);
                        printf('<p>%s</p>', date_format($starting, 'M d, Y'));
                        ?>
                    </div>

                    <!-- Ending -->
                    <div class="details-flex">
                        <h5>Ending:</h5>
                        <?php
                        $ending = date_create($data['posts']->endAt);
                        printf('<p>%s</p>', date_format($ending, 'M d, Y'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="details-btns">
                <!-- Archive book -->
                <form action="<?php echo URLROOT . '/hms/hotelClientDetail/' . $data['posts']->id; ?>" method="POST" class="details-btn-form">
                    <input type="submit" name="archiveBook" value="Archive" class='detail-btn btn-right'>
                </form>
            </div>
        </div>

    </div>
</section>
<!-- Hotel Booking Details Page -->


<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>