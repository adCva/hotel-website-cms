<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Profile Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-id-card-alt"></i></h2>

        <div class="add-form w-500">
            <!-- Name -->
            <div class="details-flex">
                <h5>Name:</h5>
                <?php echo $data['posts']->firstName . " " . $data['posts']->lastName; ?>
            </div>

            <!-- Username -->
            <div class="details-flex">
                <h5>Username:</h5>
                <?php echo $data['posts']->username; ?>
            </div>

            <!-- Role -->
            <div class="details-flex">
                <h5>Role:</h5>
                <?php echo ucfirst($data['posts']->role); ?>
            </div>

            <!-- Created By -->
            <div class="details-flex">
                <h5>Created By:</h5>
                <?php echo ucfirst($data['posts']->createdBy); ?>
            </div>

            <!-- Created On(date) -->
            <div class="details-flex">
                <h5>Created On:</h5>
                <?php
                $date = date_create($data['posts']->createdOn);
                echo date_format($date, 'D M d, Y');
                ?>
            </div>

            <!-- Redirect to Change Password page -->
            <a href="<?php echo URLROOT . '/hms/changePassword/' . $data['posts']->id; ?>" class="submit" style="text-align: center;">Change Password</a>
        </div>
    </div>
</section>
<!-- End of Profile Page -->