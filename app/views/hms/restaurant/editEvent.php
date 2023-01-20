<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Edit Restaurant Event Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="far fa-calendar"></i> &nbsp; Edit Restaurant Event</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT . '/hms/editRestEvent/' . $data['posts']->id; ?>" method="POST" enctype="multipart/form-data" name="editRestDetailsForm" onsubmit="return editRestEventFormValidate()" class="add-form w-400">

            <!-- Event Image -->
            <div class="form-control split">
                <label>Image: &nbsp;</label>
                <input type="file" name="img">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['imageError'] ?>
                </span>
            </div>

            <!-- Event Name -->
            <div class="form-control">
                <input type="text" name="name" value="<?php echo $data['posts']->name; ?>">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['nameError'] ?>
                </span>
            </div>

            <!-- Event Details -->
            <div class="form-control">
                <textarea name="details" id="" cols="30" rows="10">
                <?php echo $data['posts']->details; ?></textarea>
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['detailsError'] ?>
                </span>
            </div>

            <!-- Event Day -->
            <div class="form-control split">
                <label>Day: </label>
                <input type="date" name="day" value="<?php echo $data['posts']->day; ?>">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['dayError'] ?>
                </span>
            </div>

            <!-- Event Price -->
            <div class="form-control">
                <input type="number" name="price" value="<?php echo $data['posts']->price; ?>">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['priceError'] ?>
                </span>
            </div>
            <!-- Submit -->
            <input type="submit" name="submit" value="Edit Event" class="submit">
        </form>
        <!-- End of Form -->
    </div>
</section>
<!-- End of Edit Restaurant Event Page -->

<script>
    // Add Restaurant Event Form Validation
    function editRestEventFormValidate() {
        // The form variables
        let eventName = document.forms["editRestDetailsForm"]["name"].value;
        let eventDetails = document.forms["editRestDetailsForm"]["details"].value;
        let eventDay = document.forms["editRestDetailsForm"]["day"].value;
        let eventPrice = document.forms["editRestDetailsForm"]["price"].value;

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (eventName == "") {
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