<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>


<!-- Edit User Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-user-edit"></i> &nbsp; Edit User</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT . '/hms/editUser/' . $data['post']->id; ?>" method="POST" name="editUserForm" onsubmit="return editUserValidation()" class="add-form w-500">

            <!-- First Name -->
            <div class="form-control">
                <input type="text" name="firstName" value="<?php echo $data['post']->firstName; ?>">
            </div>

            <!-- Last Name -->
            <div class="form-control">
                <input type="text" name="lastName" value="<?php echo $data['post']->lastName; ?>">
            </div>

            <!-- Username -->
            <div class="form-control">
                <input type="text" name="username" value="<?php echo $data['post']->username; ?>">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['nameError']; ?>
                </span>
            </div>

            <!-- Role -->
            <div class="form-control">
                <select name="role">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="basic">Basic</option>
                </select>
            </div>

            <!-- Hidden, createdBy, createdOn, id, submit -->
            <input type="hidden" name="createdBy" value="<?php echo $_SESSION['name']; ?>">
            <input type="hidden" name="createdOn" value="<?php echo date("Y-m-d"); ?>">
            <input type="hidden" name="id" value="<?php echo $data['post']->id; ?>">
            <input type="submit" name="submit" value="Update" class="submit">
        </form>
        <!-- End of Form -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>If changed the username has to be unique. </h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>To change the password, please login and access the change password page from the profile tab.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>The default displayed role (which is admin) in not necessarily the same as the one of the user. Please assign the correct role for the user.</h2>
            </div>
        </div>
    </div>
</section>
<!-- End of Edit User Page -->

<script>
    // Edit User Form Validation
    function editUserValidation() {
        // The form variables
        let formFirstName = document.forms["editUserForm"]["firstName"].value;
        let formLastName = document.forms["editUserForm"]["lastName"].value;
        let formUsername = document.forms["editUserForm"]["username"].value;
        let formRole = document.forms["editUserForm"]["role"].value;

        // Validation
        if (formFirstName == "") {
            alert("First Name is empty.");
            return false;
        } else if (formLastName == "") {
            alert("Last Name is empty.");
            return false;
        } else if (formUsername == "") {
            alert("Username is empty.");
            return false;
        } else if (formRole == "null" || formRole == "null" || formRole == "") {
            alert("Please select the role.");
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