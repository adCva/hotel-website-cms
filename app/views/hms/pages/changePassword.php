<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>


<!-- Change Password Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-key"></i> &nbsp; Change Password</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT . '/hms/changePassword/' . $data['posts']->id; ?>" method="POST" name="changePwdForm" onsubmit="return changePwdValidate()" class="add-form w-500">

            <div class="form-control">
                <input type="password" name="old" placeholder="Current Password *">
                <span style="font-size: 1rem; color: #d9534f;">
                    <?php echo $data['oldError'] ?>
                </span>
            </div>

            <div class="form-control">
                <input type="password" name="new" placeholder="New Password *">
            </div>

            <div class="form-control">
                <input type="password" name="confirm" placeholder="Confirm New Password *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['confirmError'] ?>
                </span>
            </div>

            <input type="submit" name='submit' value="Change" class="submit">
        </form>

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>The password must be at least 6 characters long.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>If you don't remember your current password, please contact your manager.</h2>
            </div>
        </div>
    </div>
</section>
<!-- End of Change Password Page -->


<script>
    // Change Password Form Validation
    function changePwdValidate() {
        // The form variables
        let currentPwd = document.forms["changePwdForm"]["old"].value;
        let newPwd = document.forms["changePwdForm"]["new"].value;
        let confirmNewPwd = document.forms["changePwdForm"]["confirm"].value;

        // Validation
        if (currentPwd == "") {
            alert("Current Password is empty.");
            return false;
        } else if (newPwd == "") {
            alert("New Password is empty.");
            return false;
        } else if (newPwd.length <= 6) {
            alert("The Password must be at least 6 characters long.");
            return false;
        } else if (confirmNewPwd == "") {
            alert("Confirm Password is empty.");
            return false;
        } else if (newPwd !== confirmNewPwd) {
            alert("New Password and Confirm New Password do not match.");
            return false;
        }
    }


    // Stop the form re-submiting on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>