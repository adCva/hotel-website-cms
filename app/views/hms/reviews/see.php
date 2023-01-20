<?php
// Redirect to login page if there is no username set.
if (!$_SESSION['username']) {
    header("Location:" . URLROOT . "/hms/login");
}

// Sidebar
require_once APPROOT . "/views/hms/includes/sidebar.php";

// Pagination
$resaultPerPage = 10;
$totalRows = $data['rows'];
$numberOfPages = ceil($totalRows / $resaultPerPage);
?>

<!-- See Reviews Page -->
<section class="index">
    <div class="content-box column">
        <!-- Page Title and Total Active Reviews Count -->
        <div class="title-create">
            <h2 style="margin-right: 1.5rem;"><i class="fas fa-graduation-cap"></i> &nbsp; Reviews</h2>
            <h2>Active Reviews: <?php echo $data["totalActive"]; ?></h2>
        </div>
        <!-- Searchbox -->
        <div class="search-box">
            <input type="text" id="filter" onkeyup="filter()" class="search" placeholder="Search...">
            <i class="fas fa-search"></i>
        </div>

        <!-- Table -->
        <table id="table">
            <thead>
                <tr class="header">
                    <th>From</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td><?php echo $post->fromClient; ?></td>
                        <td><?php echo $post->clientEmail; ?></td>
                        <td>
                            <?php
                            $created = date_create($post->created);
                            echo date_format($created, 'M d, Y');
                            ?>
                        </td>
                        <td><?php echo ucwords($post->status); ?></td>
                        <!-- Redirect to review details page -->
                        <td><a href="<?php echo URLROOT . '/hms/reviewDetail/' . $post->id; ?>" style="color: #0e4892"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End of Table -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>Only the reviews with a status of Active will be shown on the main page.</h2>
            </div>
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>Only 5 reviews can have an Active status.</h2>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo "<a class='pageee' href='http://localhost/juno/hms/seeReviews?page=" . $page . "'>" . $page . "</a> ";
            }
            ?>
        </div>
</section>
<!-- End of See Reviews Page -->

<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>