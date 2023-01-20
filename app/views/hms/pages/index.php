<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>


<!-- INDEX PAGE -->
<section class="index">
    <div class="content-box column">

        <h2 class="home-message" style="margin-bottom: 1rem;">Hello <?php echo $_SESSION['name'] ?></h2>

        <!-- Dashboard -->
        <div class="dasboard grid">
            <!-- Hotel Bookings -->
            <div class="dashboard-box" style="background-color: #f9c6c9;">
                <h4>Hotel Booking Added, Today</h4>
                <p><?php echo $data['hotelReservationCreatedToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeHotelReservation" class="index-btn">See More</a>
            </div>

            <div class="dashboard-box" style="background-color: #dbcdf0;">
                <h4>Hotel Booking Starting Today</h4>
                <p><?php echo $data['hotelReservationToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeHotelReservation" class="index-btn">See More</a>
            </div>

            <!-- Restaurant Bookings and Events -->
            <div class="dashboard-box" style="background-color: #f2c6de;">
                <h4>Restaurant Bookings Today</h4>
                <p><?php echo $data['restaurantBookingsToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeRestaurantReservation" class="index-btn">See More</a>
            </div>

            <div class="dashboard-box" style="background-color: #c6def1;">
                <h4>Restaurant Event Today</h4>
                <p><?php echo $data['restaurantEventToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeRestaurantEvents" class="index-btn">See More</a>
            </div>

            <!-- Internal Event -->
            <div class="dashboard-box" style="background-color: #c9e4de;">
                <h4>Internal Event Today</h4>
                <p><?php echo $data['internalEventToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeEvent" class="index-btn">See More</a>
            </div>

            <!-- New Review -->
            <div class="dashboard-box" style="background-color: #faedcb;">
                <h4>New Review</h4>
                <p><?php echo $data['reviewAddedToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeReviews" class="index-btn">See More</a>
            </div>

            <!-- Offer Ending Today -->
            <div class="dashboard-box" style="background-color: #f7d9c4;">
                <h4>Offer Ending Today</h4>
                <p><?php echo $data['hotelReservationToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeOffer" class="index-btn">See More</a>
            </div>

            <!-- Help Request Today -->
            <div class="dashboard-box" style="background-color: #d2d2cf;">
                <h4>Help Request Today</h4>
                <p><?php echo $data['helpRequestToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeHelp" class="index-btn">See More</a>
            </div>

            <!-- Help Request Deadline -->
            <div class="dashboard-box" style="background-color: #e2cfc4;">
                <h4>Help Request Deadline Today</h4>
                <p><?php echo $data['helpRequestDeadlineToday']; ?></p>
                <a href="<?php echo URLROOT; ?>/hms/seeHelp" class="index-btn">See More</a>
            </div>
        </div>
        <!-- End of Dashboard -->

        <!-- Details Text -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>Remember to refresh the page often so that you can see the updates in real time.</h2>
            </div>
        </div>
    </div>
</section>
<!-- END OF INDEX PAGE -->