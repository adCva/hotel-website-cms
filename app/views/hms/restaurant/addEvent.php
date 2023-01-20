<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Add Restaurant Event Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="far fa-calendar-plus"></i> &nbsp; Add Restaurant Event</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT; ?>/hms/addRestaurantEvent" method="POST" enctype="multipart/form-data" name="restEventForm" onsubmit="return restEventFormValidate()" class="add-form w-400">

            <!-- Event Image -->
            <div class="form-control split">
                <label>Image: &nbsp;</label>
                <input type="file" name="img">
            </div>

            <!-- Event Name -->
            <div class="form-control">
                <input type="text" name="name" placeholder="Name *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['nameError'] ?>
                </span>
            </div>

            <!-- Event Details -->
            <div class="form-control">
                <input type="text" name="details" placeholder="Details *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['detailsError'] ?>
                </span>
            </div>

            <!-- Event Day -->
            <div class="form-control split">
                <label>Day: </label>
                <input type="date" name="day" placeholder="Day *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['dayError'] ?>
                </span>
            </div>

            <!-- Event Price -->
            <div class="form-control">
                <input type="number" name="price" placeholder="Price *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['priceError'] ?>
                </span>
            </div>
            <!-- Submit -->
            <input type="submit" name="submit" value="Add Event" class="submit">
        </form>
        <!-- End of Form -->
    </div>
</section>
<!-- End of Add Restaurant Event Page -->

<script>
    // Add Restaurant Event Form Validation
    function restEventFormValidate() {
        // The form variables
        let eventImage = document.forms["restEventForm"]["img"].value;
        let eventName = document.forms["restEventForm"]["name"].value;
        let eventDetails = document.forms["restEventForm"]["details"].value;
        let eventDay = document.forms["restEventForm"]["day"].value;
        let eventPrice = document.forms["restEventForm"]["price"].value;

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (eventImage == "") {
            alert("Event Image is empty.");
            return false;
        } else if (eventName == "") {
            alert("Event Name is empty.");
            return false;
        } else if (eventDetails == "") {
            alert("Event Details is empty.");
            return false;
        } else if (eventDay == "") {
            alert("Event Day is empty.");
            return false;
        } else if (eventDay < chechAgainstDate) {
            alert("Event Day is not valid.");
            return false;
        } else if (eventPrice == "") {
            alert("Event Price is empty.");
            return false;
        }
    }


    // Stop the form re-submiting on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>