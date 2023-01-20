<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>


<!-- Edit Rooms Type Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-igloo"></i> &nbsp; Edit Room</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT . '/hms/editRoom/' . $data['posts']->id; ?>" method="POST" enctype="multipart/form-data" name="editRoomForm" onsubmit="return editRoomValidate()" class="add-form">

            <div class="form-grid">
                <div class="left">
                    <!-- Room Type -->
                    <div class="form-control">
                        <input type="text" name="type" value="<?php echo $data['posts']->roomType; ?>">
                        <span style="font-size: 1rem; color: #d9534f">
                            <?php echo $data['typeError'] ?>
                        </span>
                    </div>

                    <!-- Room Size -->
                    <div class="form-control">
                        <input type="number" name="size" value="<?php echo $data['posts']->roomSize; ?>">
                        <span style="font-size: 1rem; color: #d9534f">
                            <?php echo $data['sizeError'] ?>
                        </span>
                    </div>

                    <!-- Room Bed -->
                    <div class="form-control">
                        <input type="text" name="bed" value="<?php echo $data['posts']->roomBed; ?>">
                        <span style="font-size: 1rem; color: #d9534f">
                            <?php echo $data['bedError'] ?>
                        </span>
                    </div>

                    <!-- Room Total -->
                    <div class="form-control">
                        <input type="number" name="total" value="<?php echo $data['posts']->roomTotal_Of_Type; ?>">
                        <span style="font-size: 1rem; color: #d9534f">
                            <?php echo $data['totalError'] ?>
                        </span>
                    </div>

                    <!-- Room Price -->
                    <div class="form-control">
                        <input type="number" name="price" value="<?php echo $data['posts']->roomPrice; ?>">
                        <span style="font-size: 1rem; color: #d9534f">
                            <?php echo $data['priceError'] ?>
                        </span>
                    </div>
                </div>

                <!-- Room Image -->
                <div class="right">
                    <div class="form-control split">
                        <label>Image: &nbsp;</label>
                        <input type="file" name="img">
                        <span style="font-size: 1rem; color: #d9534f">
                            <?php echo $data['imageError'] ?>
                        </span>
                    </div>

                    <!-- Room Description -->
                    <div class="form-control">
                        <textarea name="description" cols="30" rows="10" placeholder="Room Description *"><?php echo $data['posts']->roomDescription; ?></textarea>
                        <span style="font-size: 1rem; color: #d9534f">
                            <?php echo $data['descriptionError'] ?>
                        </span>
                    </div>
                </div>
            </div>
            <!-- Submit -->
            <input type="submit" name="submit" value="Edit Room" class="submit">
        </form>
        <!-- Form -->

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
<!-- End of Edit Rooms Type Page -->

<script>
    // Edit Room Form Validation
    function editRoomValidate() {
        // The form variables
        let roomType = document.forms["editRoomForm"]["type"].value;
        let roomSize = document.forms["editRoomForm"]["size"].value;
        let roomBed = document.forms["editRoomForm"]["bed"].value;
        let roomTotal = document.forms["editRoomForm"]["total"].value;
        let roomPrice = document.forms["editRoomForm"]["price"].value;
        let roomImage = document.forms["editRoomForm"]["img"].value;
        let roomDescription = document.forms["editRoomForm"]["description"].value;

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