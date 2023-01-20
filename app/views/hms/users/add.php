<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Add User Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-plus"></i> &nbsp; User</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT; ?>/hms/addUser" method="POST" name="addUserForm" onsubmit="return addUserValidate()" class="add-form w-500">

            <!-- First Name -->
            <div class="form-control">
                <input type="text" name="firstName" placeholder="First Name *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['firstNameError']; ?>
                </span>
            </div>

            <!-- Last Name -->
            <div class="form-control">
                <input type="text" name="lastName" placeholder="Last Name *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['lastNameError']; ?>
                </span>
            </div>

            <!-- Username -->
            <div class="form-control">
                <input type="text" name="username" placeholder="Username *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['usernameError']; ?>
                </span>
            </div>

            <!-- Password -->
            <div class="form-control">
                <input type="password" name="password" placeholder="Password *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['passwordError']; ?>
                </span>
            </div>

            <!-- Role -->
            <div class="form-control">
                <select name="role">
                    <option value="default">-- Role --</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="basic">Basic</option>
                </select>
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['roleError']; ?>
                </span>
            </div>

            <!-- Hidden, createdBy, createdOn, submit -->
            <input type="hidden" name="createdBy" value="<?php echo $_SESSION['name']; ?>">
            <input type="hidden" name="createdOn" value="<?php echo date("Y-m-d"); ?>">
            <input type="submit" name="submit" value="Create" class="submit">
        </form>
        <!-- Form -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>The username has to be unique. </h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>The password must be at least 6 characters long. </h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>Remember to select a role for this new user. </h2>
            </div>
        </div>
    </div>
</section>
<!-- End of Add User Page -->

<script>
    // Change Password Form Validation
    function addUserValidate() {
        // The form variables
        let formFirstName = document.forms["addUserForm"]["firstName"].value;
        let formLastName = document.forms["addUserForm"]["lastName"].value;
        let formUsername = document.forms["addUserForm"]["username"].value;
        let formPassword = document.forms["addUserForm"]["password"].value;
        let formRole = document.forms["addUserForm"]["role"].value;

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
        } else if (formPassword == "") {
            alert("Password is empty.");
            return false;
        } else if (formPassword.length <= 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        } else if (formRole == "default") {
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