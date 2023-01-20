<?php
require_once APPROOT . "/views/hms/includes/header.php";
$activeArea = $_GET['s'] ?? "";
?>


<!-- SIDEBAR -->
<div class="sidebar">
    <!-- LOGO -->
    <div class="sidebar-logo">
        <div class="logo">
            <h1 class="logo-icon"><i class="fas fa-h-square"></i></h1>
            <div class="logo-name-star">
                <h1 class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h1>
                <h1>Juno Hotel</h1>
            </div>
        </div>
    </div>

    <!-- MENU -->
    <div class="sidebar-menu">
        <!-- HOME AND PROFILE -->
        <a href="<?php echo URLROOT; ?>/hms/index" class="link sidebar-hover"><i class="fas fa-home"></i> &nbsp; Home</a>
        <a href="<?php echo URLROOT . '/hms/profile/' .  $_SESSION['id'] ?>" class="link sidebar-hover"><i class="far fa-user-circle"></i> &nbsp; Profile</a>

        <!-- HR -->
        <div class="dropdown-container">
            <div id="dropdown-btn" class="link-group sidebar-hover" onclick="dropDownMenu(this)">
                <div class="btn-title"><i class="fas fa-users"></i> &nbsp HR Management</div>
                <div class="down-icon"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/hms/addUser" class="sidebar-hover">Add User</a>
                <a href="<?php echo URLROOT; ?>/hms/seeUsers" class="sidebar-hover">See Users</a>
                <a href="<?php echo URLROOT; ?>/hms/employees" class="sidebar-hover">See Employees</a>
            </div>
        </div>

        <!-- ROOMS -->
        <div class="dropdown-container">
            <div id="dropdown-btn" class="link-group sidebar-hover" onclick="dropDownMenu(this)">
                <div class="btn-title"><i class="fas fa-bed"></i> &nbsp Rooms</div>
                <div class="down-icon"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/hms/addRoom" class="sidebar-hover">Add Room Type</a>
                <a href="<?php echo URLROOT; ?>/hms/seeRooms" class="sidebar-hover">See All Room Types</a>
            </div>
        </div>

        <!-- OFFERS -->
        <div class="dropdown-container">
            <div id="dropdown-btn" class="link-group sidebar-hover" onclick="dropDownMenu(this)">
                <div class="btn-title"><i class="fas fa-coins"></i> &nbsp Offers</div>
                <div class="down-icon"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/hms/addOffer" class="sidebar-hover">Add Offer</a>
                <a href="<?php echo URLROOT; ?>/hms/seeOffer" class="sidebar-hover">See Offers</a>
            </div>
        </div>

        <!-- INTERNAL EVENTS -->
        <div class="dropdown-container">
            <div id="dropdown-btn" class="link-group sidebar-hover" onclick="dropDownMenu(this)">
                <div class="btn-title"><i class="fas fa-calendar"></i> &nbsp Internal Events</div>
                <div class="down-icon"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/hms/addEvent" class="sidebar-hover">Add Event</a>
                <a href="<?php echo URLROOT; ?>/hms/seeEvent" class="sidebar-hover">See Events</a>
            </div>
        </div>

        <!-- BOOKINGS -->
        <div class="dropdown-container">
            <div id="dropdown-btn" class="link-group sidebar-hover" onclick="dropDownMenu(this)">
                <div class="btn-title"><i class="fas fa-book-reader"></i> &nbsp Bookings</div>
                <div class="down-icon"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/hms/seeHotelReservation" class="sidebar-hover">Hotel Bookings</a>
                <a href="<?php echo URLROOT; ?>/hms/seeRestaurantReservation" class="sidebar-hover">Restaurant Bookings</a>
            </div>
        </div>

        <!-- CUSTOMER HELP -->
        <a href="<?php echo URLROOT; ?>/hms/seeHelp" class="link sidebar-hover"><i class="fas fa-hand-holding-medical"></i> &nbsp Customer Help</a>

        <!-- RESTAURANT -->
        <div class="dropdown-container">
            <div id="dropdown-btn" class="link-group sidebar-hover" onclick="dropDownMenu(this)">
                <div class="btn-title"><i class="fas fa-utensils"></i> &nbsp Restaurant</div>
                <div class="down-icon"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/hms/seeMenu" class="sidebar-hover">Menu</a>
                <a href="<?php echo URLROOT; ?>/hms/seeRestaurantEvents" class="sidebar-hover">Events</a>
            </div>
        </div>


        <!-- REVIEWS AND ARCHIVE -->
        <a href="<?php echo URLROOT; ?>/hms/seeReviews" class="link sidebar-hover"><i class="fas fa-certificate"></i> &nbsp; Reviews</a>
        <a href="<?php echo URLROOT; ?>/hms/seeArchive" class="link sidebar-hover"><i class="fas fa-archive"></i> &nbsp; Archive</a>


    </div>
    <!-- END OF MENU -->

    <!-- LOGOUT -->
    <a href="<?php echo URLROOT; ?>/hms/logout" class="sidebar-logout" onclick="alert('Yeet...');"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
<!-- END OF SIDEBAR -->



<script>
    // SIDEBAR DROPDOWN
    function dropDownMenu(body) {
        body.parentNode.querySelector(".dropdown-content").classList.toggle("active");
    }
</script>