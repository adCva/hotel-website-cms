<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- Resolve Request Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-hand-holding-medical"></i> &nbsp; Help Request Response</h2>
        <div class="add-form">
            <div class="form-grid">
                <div class="left">

                    <!-- Request From -->
                    <div class="form-control b-bottom">
                        <h2>Client Name: </h2>
                        <p><?php printf("%s", $data['posts']->client); ?></p>
                    </div>

                    <!-- Request Email -->
                    <div class="form-control b-bottom">
                        <h2>Client Email: </h2>
                        <p><?php printf("%s", $data['posts']->clientEmail); ?></p>
                    </div>

                    <!-- Request Created Date -->
                    <div class="form-control b-bottom">
                        <h2>Problem Created On: </h2>
                        <p>
                            <?php
                            $created = date_create($data['posts']->fromDate);
                            printf("%s", date_format($created, 'M d, Y'));
                            ?>
                        </p>
                    </div>

                    <!-- Request Deadline -->
                    <div class="form-control b-bottom">
                        <h2>Problem Deadline: </h2>
                        <p>
                            <?php
                            $deadline = date_create($data['posts']->deadline);
                            printf("%s", date_format($deadline, 'M d, Y'));
                            ?>
                        </p>
                    </div>

                    <!-- Request Description -->
                    <div class="form-control">
                        <h2>Client Problem: </h2>
                        <p><?php printf("%s", $data['posts']->description); ?></p>
                    </div>

                </div>

                <div class="right">
                    <!-- Request Solution Form -->
                    <form method="POST" action="<?php echo URLROOT . '/hms/resolveRequest/' . $data['posts']->id ?>" name="solutionForm" onsubmit="return responseValidate()" class="nested-form">
                        <textarea name="solution" cols="30" rows="10" required placeholder="Response *"></textarea>
                        <input type="hidden" name='emailTo' value="<?php echo $data['posts']->clientEmail; ?>">
                        <input type="hidden" name="user" value="<?php echo $_SESSION['username']; ?>">
                        <input type="hidden" name='subject' value="Your Hotel Request">
                        <input type="submit" name="resolve" value="Send" class="nested-form-submit">
                    </form>
                    <!-- End of Request Solution Form -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of Resolve Request Page -->

<script>
    // Help Request Response Form Validation, delete the --required-- and it will work
    function responseValidate() {
        // The form variables
        let response = document.forms["solutionForm"]["solution"].value;

        // Validation
        if (response == "") {
            alert("The response is empty.");
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