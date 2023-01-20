<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Add Menu Item Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-plus"></i> &nbsp; Add Menu Item</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT; ?>/hms/addMenuItem" method="POST" enctype="multipart/form-data" name="menuItemForm" onsubmit="return menuItemFormValidate()" class="add-form w-400">

            <!-- Menu Item Image -->
            <div class="form-control split">
                <label>Image: &nbsp;</label>
                <input type="file" name="img">
            </div>

            <!-- Menu Item Name -->
            <div class="form-control">
                <input type="text" name="name" placeholder="Name *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['nameError']; ?>
                </span>
            </div>

            <!-- Menu Item Ingredients -->
            <div class="form-control">
                <input type="text" name="ingredients" placeholder="Ingredients *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['ingredientsError'] ?>
                </span>
            </div>

            <!-- Menu Item Description -->
            <div class="form-control">
                <textarea name="description" cols="30" rows="10" placeholder="Description *"></textarea>
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['descriptionError'] ?>
                </span>
            </div>

            <!-- Menu Item Price -->
            <div class="form-control">
                <input type="number" name="price" placeholder="Price *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['priceError'] ?>
                </span>
            </div>
            <!-- Submit -->
            <input type="submit" name="submit" value="Add Offer" class="submit">
        </form>
        <!-- End of Form -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>People want to eat not read a life story so a short description will do fine. Describe the plate as simple as possible.</h2>
            </div>
        </div>
    </div>
</section>
<!-- End of Add Menu Item Page -->

<script>
    // Add Menu Item Form Validation
    function menuItemFormValidate() {
        // The form variables
        let menuImage = document.forms["menuItemForm"]["img"].value;
        let menuName = document.forms["menuItemForm"]["name"].value;
        let menuIngredients = document.forms["menuItemForm"]["ingredients"].value;
        let menuDescription = document.forms["menuItemForm"]["description"].value;
        let menuPrice = document.forms["menuItemForm"]["price"].value;

        // Validation
        if (menuImage == "") {
            alert("Menu Item Image is empty.");
            return false;
        } else if (menuName == "") {
            alert("Menu Item Name is empty.");
            return false;
        } else if (menuIngredients == "") {
            alert("Menu Item Ingredients are empty.");
            return false;
        } else if (menuDescription == "") {
            alert("Menu Item Description is empty.");
            return false;
        } else if (menuPrice == "") {
            alert("Menu Item Price is empty.");
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