<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Add Internal Event Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-plus"></i> &nbsp; Event</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT; ?>/hms/addEvent" method="POST" name="inEventForm" onsubmit="return internalEventValidate()" class="add-form w-400">

            <!-- Internal Event Name -->
            <div class="form-control">
                <input type="text" name="name" placeholder="Event Name *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['nameError'] ?>
                </span>
            </div>

            <!-- Internal Event Date -->
            <div class="form-control split">
                <label>Event Date</label>
                <input type="date" name="created" placeholder="Event Created *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['createdError'] ?>
                </span>
            </div>

            <!-- Internal Event Description -->
            <div class="form-control">
                <textarea name="description" cols="30" rows="10" placeholder="Event Description *"></textarea>
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['descriptionError'] ?>
                </span>
            </div>
            <!-- Submit -->
            <input type="submit" name="submit" value="Add Event" class="submit">
        </form>
        <!-- End of Form -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>For internal use only. For Restaurant Events see Events in the Restaurant tab.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>As this is an internal event, a short description will do fine, use keywords such as cleaning, buy, meeting and so on.</h2>
            </div>
        </div>
    </div>
</section>
<!-- End of Add Internal Event Page -->

<script>
    // Add Offer Form Validation
    function internalEventValidate() {
        // The form variables
        let eventName = document.forms["inEventForm"]["name"].value;
        let eventDate = document.forms["inEventForm"]["created"].value;
        let eventDescription = document.forms["inEventForm"]["description"].value;

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (eventName == "") {
            alert("Event Name is empty.");
            return false;
        } else if (eventDate == "") {
            alert("Event Date is empty.");
            return false;
        } else if (eventDate < chechAgainstDate) {
            alert("Event Date is not valid.");
            return false;
        } else if (eventDescription == "") {
            alert("Event Description is empty.");
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