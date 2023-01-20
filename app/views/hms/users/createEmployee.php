<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Create Employee Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-plus"></i> &nbsp; Add Employee.</h2>
        <!-- Form -->
        <form action="<?php echo URLROOT; ?>/hms/createEmployee" method="POST" name="createEmployeeForm" onsubmit="return confirm('Are you sure you want to add this employee?');" class="add-form w-500">

            <!-- First Name -->
            <div class="form-control">
                <input type="text" name="firstName" placeholder="First Name *">
            </div>

            <!-- Last Name -->
            <div class="form-control">
                <input type="text" name="lastName" placeholder="Last Name *">
            </div>

            <!-- Role -->
            <div class="form-control">
                <input type="text" name="role" placeholder="Role *">
                <span style="font-size: 1rem; color: #d9534f">
                    <?php echo $data['nameError']; ?>
                </span>
            </div>

            <!-- Hidden, employeedOn, submit -->
            <input type="hidden" name="employeeddOn" value="<?php echo date("Y-m-d"); ?>">
            <input type="submit" name="submit" value="Create" class="submit">
        </form>
        <!-- End of Form -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>Remember to specify a role so that the employee can be easily identified.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>No need for a password as this will serve only as a list of employees.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>However, if you want to give this employee access to the HMS please create a new user on the Add User page located in the HR Management tab.</h2>
            </div>
        </div>
    </div>
</section>
<!-- End of Create Employee Page -->

<script>
    // Create Employee Form Validation
    function employeeFormValidate() {
        // The form variables
        let employeeFirstName = document.forms["createEmployeeForm"]["firstName"].value;
        let employeeLastName = document.forms["createEmployeeForm"]["lastName"].value;
        let employeeRole = document.forms["createEmployeeForm"]["role"].value;

        // Validation
        if (employeeFirstName == "") {
            alert("First Name is empty.");
            return false;
        } else if (employeeLastName == "") {
            alert("Last Name is empty.");
            return false;
        } else if (employeeRole == "") {
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