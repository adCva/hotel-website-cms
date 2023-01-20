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

<!-- See Offers Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-see-message"><i class="fas fa-coins"></i> &nbsp; Offers List</h2>
        <!-- Searchbox -->
        <div class="search-box">
            <input type="text" id="filter" onkeyup="filter()" class="search" placeholder="Search...">
            <i class="fas fa-search"></i>
        </div>

        <!-- Table -->
        <table id="table">
            <thead>
                <tr class="header">
                    <th>Name</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Price</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td><?php echo $post->offerName; ?></td>
                        <td>
                            <?php
                            $start = date_create($post->offerStart);
                            echo date_format($start, 'M d, Y');
                            ?>
                        </td>
                        <td>
                            <?php
                            $end = date_create($post->offerEnd);
                            echo date_format($end, 'M d, Y');
                            ?>
                        </td>
                        <td><?php echo '$ ' . $post->offerPrice; ?></td>
                        <td><a href="<?php echo URLROOT . '/hms/offerDetail/' . $post->id; ?>" style="color: #0e4892"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End of Table -->

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo "<a class='pageee' href='http://localhost/juno/hms/seeOffer?page=" . $page . "'>" . $page . "</a> ";
            }
            ?>
        </div>
    </div>
</section>
<!-- End of See Offers Page -->

<script>
    // Active page on page btns
    let activePage = (window.location.href).split("=")[1];
    let allPages = document.querySelectorAll(".pageee");
    if (activePage == undefined) {
        allPages[0].classList.add("active-pageee");
    } else {
        allPages[activePage - 1].classList.add("active-pageee");
    }
</script>

<!-- Footer -->
<?php require_once APPROOT . "/views/hms/includes/footer.php"; ?>