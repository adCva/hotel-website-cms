<?php
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}
$archive = URLROOT . "/hms/archive";
$today = date("Y-m-d");
require_once APPROOT . "/views/hms/includes/sidebar.php";
?>

<section class="index">
    <div class="content-box column">
        <h2 class="home-message"><i class="fas fa-archive"></i> &nbsp; Archive Details</h2>


        <div class="details">
            <div class="details-flex">
                <h5>From:</h5>
                <?php printf('<p>%s</p>', $data['posts']->archiveFrom); ?>
            </div>

            <div class="details-flex">
                <h5>Archived By:</h5>
                <?php printf('<p>%s</p>', $data['posts']->archiveBy); ?>
            </div>

            <div class="details-flex">
                <h5>Archived Date:</h5>
                <?php
                $archived = date_create($data['posts']->archiveDate);
                printf('<p>%s</p>', date_format($archived, 'M d, Y'));
                ?>
            </div>

            <?php
            $descriptions = explode("_", $data['posts']->archiveDescription);
            foreach ($descriptions as $description) :
            ?>
                <div class="details-desc">
                    <?php printf('<p>%s</p>', $description); ?>
                </div>
            <?php endforeach; ?>

            <div class="details-btns">
                <a href="<?php echo URLROOT . '/hms/deleteArchive/' . $data['posts']->id; ?>" class='detail-btn btn-right'>Delete</a>
            </div>
        </div>

    </div>
</section>

<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>