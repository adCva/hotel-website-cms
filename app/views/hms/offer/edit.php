<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>


<!-- Edit Offer Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-coins"></i> &nbsp; Edit Offer</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT . '/hms/editOffer/' . $data['posts']->id; ?>" method="POST" enctype="multipart/form-data" name="editOfferForm" onsubmit="return " class="add-form w-400">

            <!-- Offer Image -->
            <div class="form-control split">
                <label>Image: &nbsp;</label>
                <input type="file" name="img">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['imageError'] ?>
                </span>
            </div>

            <!-- Offer Name -->
            <div class="form-control">
                <input type="text" name="name" value="<?php echo $data['posts']->offerName; ?>">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['nameError'] ?>
                </span>
            </div>

            <!-- Offer Start -->
            <div class="form-control split">
                <label>Offer Start</label>
                <input type="date" name="start" value="<?php echo $data['posts']->offerStart; ?>">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['startError'] ?>
                </span>
            </div>

            <!-- Offer End -->
            <div class="form-control split">
                <label>Offer End</label>
                <input type="date" name="end" value="<?php echo $data['posts']->offerEnd; ?>">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['endError'] ?>
                </span>
            </div>

            <!-- Offer Description -->
            <div class="form-control">
                <textarea name="description" cols="30" rows="10"><?php echo $data['posts']->offerDescription; ?></textarea>
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['descriptionError'] ?>
                </span>
            </div>

            <!-- Offer Price -->
            <div class="form-control">
                <input type="number" name="price" value="<?php echo $data['posts']->offerPrice; ?>">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['priceError'] ?>
                </span>
            </div>
            <!-- Submit -->
            <input type="submit" name="submit" value="Edit Offer" class="submit">
        </form>
        <!-- End of Form -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>If not provided, the image will remain the same.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>A short description will do fine.</h2>
            </div>
        </div>

    </div>
</section>
<!-- End of Edit Offer Page -->

<script>
    // Edit Room Form Validation
    function editOfferValidate() {
        // The form variables
        let offerName = document.forms["editOfferForm"]["name"].value;
        let offerStart = document.forms["editOfferForm"]["start"].value;
        let offerEnd = document.forms["editOfferForm"]["end"].value;
        let offerDerscription = document.forms["editOfferForm"]["description"].value;
        let offerPrice = document.forms["editOfferForm"]["price"].value;

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (offerName == "") {
            alert("Offer Name is empty.");
            return false;
        } else if (offerStart == "") {
            alert("Offer Start is empty.");
            return false;
        } else if (offerStart < chechAgainstDate) {
            alert("Offer Start is not valid.");
            return false;
        } else if (offerEnd == "") {
            alert("Offer End is empty.");
            return false;
        } else if (offerEnd == offerStart) {
            alert("Offer Start and Offer End cannot be the same.");
            return false;
        } else if (offerEnd < chechAgainstDate) {
            alert("Offer End is not valid.");
            return false;
        } else if (offerDerscription == "") {
            alert("Offer Description is empty.");
            return false;
        } else if (offerPrice == "") {
            alert("Offer Price is empty.");
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