<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<!-- See Customers Request Details Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-hand-holding-medical"></i> &nbsp; Request Details</h2>


        <div class="details">
            <div class="details-grid">
                <div class="details-left">
                    <!-- Request from name -->
                    <div class="details-flex">
                        <h5>Client:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->client); ?>
                    </div>

                    <!-- Request from email -->
                    <div class="details-flex">
                        <h5>Email:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->clientEmail); ?>
                    </div>

                    <!-- Request from date -->
                    <div class="details-flex">
                        <h5>Created:</h5>
                        <?php
                        $created = date_create($data['posts']->fromDate);
                        printf('<p>%s</p>', date_format($created, 'M d, Y'));
                        ?>
                    </div>
                </div>
                <div class="details-right">
                    <!-- Request deadline -->
                    <div class="details-flex">
                        <h5>Deadline:</h5>
                        <?php
                        $deadline = date_create($data['posts']->deadline);
                        printf('<p>%s</p>', date_format($deadline, 'M d, Y'));
                        ?>
                    </div>

                    <!-- Request resolvedBy -->
                    <div class="details-flex">
                        <h5>Resolved By:</h5>
                        <?php printf('<p>%s</p>', $data['posts']->resolvedBy); ?>
                    </div>

                    <!-- Request resolvedDate -->
                    <div class="details-flex">
                        <h5>Resolved Date:</h5>
                        <?php
                        $resolved = date_create($data['posts']->resolvedDate);
                        printf('<p>%s</p>', date_format($resolved, 'M d, Y'));
                        ?>
                    </div>
                </div>
            </div>

            <!-- Request Problem -->
            <div class="details-desc">
                <h5>Problem:</h5>
                <?php printf('<p>%s</p>', $data['posts']->description); ?>
            </div>

            <!-- Request Solution -->
            <div class="details-desc">
                <h5>Solution Given:</h5>
                <?php printf('<p>%s</p>', $data['posts']->solution); ?>
            </div>

            <div class="details-btns">
                <!-- Redirect to resolve request page -->
                <?php if ($data['posts']->solution == "") : ?>
                    <a href="<?php echo URLROOT . '/hms/resolveRequest/' . $data['posts']->id; ?>" class="detail-btn btn-left">Resolve</a>
                <?php else : ?>
                    <!-- Archive request -->
                    <form action="<?php echo URLROOT . '/hms/requestDetails/' . $data['posts']->id; ?>" method="POST" class="details-btn-form">
                        <input type="submit" name="archiveHelp" value="Archive" class='detail-btn btn-right'>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>If the request is not resolved "Resolved By","Resolved Date", "Problem" and "Solution Given" will be empty.</h2>
            </div>
        </div>
    </div>
</section>
<!-- End of See Customers Request Details Page -->


<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>