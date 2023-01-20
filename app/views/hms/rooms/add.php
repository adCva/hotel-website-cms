<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Add Room Type Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-plus"></i> &nbsp; Add Room</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT; ?>/hms/addRoom" method="POST" enctype="multipart/form-data" name="addRoomForm" onsubmit="return addRoomValidate()" class="add-form">

            <div class="form-grid">
                <div class="left">
                    <!-- Room Type -->
                    <div class="form-control">
                        <input type="text" name="type" placeholder="Room Type *">
                        <span>
                            <?php echo $data['typeError'] ?>
                        </span>
                    </div>

                    <!-- Room Size -->
                    <div class="form-control">
                        <input type="number" name="size" placeholder="Room Size *">
                        <span>
                            <?php echo $data['sizeError'] ?>
                        </span>
                    </div>

                    <!-- Room Bed -->
                    <div class="form-control">
                        <input type="text" name="bed" placeholder="Bed and Bed Type *">
                        <span>
                            <?php echo $data['bedError'] ?>
                        </span>
                    </div>

                    <!-- Room Total -->
                    <div class="form-control">
                        <input type="number" name="total" placeholder="Total Of Type *">
                        <span>
                            <?php echo $data['totalError'] ?>
                        </span>
                    </div>

                    <!-- Room Price -->
                    <div class="form-control">
                        <input type="number" name="price" placeholder="Room Price *">
                        <span>
                            <?php echo $data['priceError'] ?>
                        </span>
                    </div>
                </div>

                <div class="right">
                    <!-- Room Image -->
                    <div class="form-control split">
                        <label>Image: &nbsp;</label>
                        <input type="file" name="img">
                        <span>
                            <?php echo $data['imageError'] ?>
                        </span>
                    </div>

                    <!-- Room Description -->
                    <div class="form-control">
                        <textarea name="description" cols="30" rows="10" placeholder="Room Description *"></textarea>
                        <span>
                            <?php echo $data['descriptionError'] ?>
                        </span>
                    </div>
                </div>
            </div>
            <!-- Submit -->
            <input type="submit" name="submit" value="Add Room" class="submit">
        </form>
        <!-- End of Form -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>Note that this is where you add room types and not individual rooms.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>If the type you want to add already exists and you want to change it, please do so in the Edit Room, which you can access in the See Rooms->Details.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>A short description will do fine.</h2>
            </div>
        </div>
    </div>
</section>
<!-- End of Add Room Type Page -->

<script>
    // Add Room Form Validation
    function addRoomValidate() {
        // The form variables
        let roomType = document.forms["addRoomForm"]["type"].value;
        let roomSize = document.forms["addRoomForm"]["size"].value;
        let roomBed = document.forms["addRoomForm"]["bed"].value;
        let roomTotal = document.forms["addRoomForm"]["total"].value;
        let roomPrice = document.forms["addRoomForm"]["price"].value;
        let roomImage = document.forms["addRoomForm"]["img"].value;
        let roomDescription = document.forms["addRoomForm"]["description"].value;

        // Validation
        if (roomType == "") {
            alert("Room Type is empty.");
            return false;
        } else if (roomSize == "") {
            alert("Room Size is empty.");
            return false;
        } else if (roomBed == "") {
            alert("Room Bed is empty.");
            return false;
        } else if (roomTotal == "") {
            alert("Room Total is empty.");
            return false;
        } else if (roomPrice == "") {
            alert("Room Price is empty.");
            return false;
        } else if (roomImage == "") {
            alert("Room Image is empty.");
            return false;
        } else if (roomDescription == "") {
            alert("Room Description is empty.");
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