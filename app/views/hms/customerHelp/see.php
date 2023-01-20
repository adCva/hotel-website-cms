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

<!-- See Customer Requests Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-see-message"><i class="fas fa-hand-holding-medical"></i> &nbsp; Help Requests</h2>
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
                    <th>Deadline</th>
                    <th>Resolved By</th>
                    <th>Resolved Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td><?php echo $post->client; ?></td>
                        <td><?php echo $post->clientEmail; ?></td>
                        <td>
                            <?php
                            $from = date_create($post->fromDate);
                            echo date_format($from, 'M d, Y');
                            ?>
                        </td>
                        <td>
                            <?php
                            $deadline = date_create($post->deadline);
                            echo date_format($deadline, 'M d, Y');
                            ?>
                        </td>
                        <td><?php echo $post->resolvedBy; ?></td>
                        <td>
                            <?php if ($post->resolvedDate == "0000-00-00") : ?>
                                Not Resolved
                            <?php else : ?>
                                <?php
                                $resolved = date_create($post->resolvedDate);
                                echo date_format($resolved, 'M d, Y');
                                ?>
                            <?php endif; ?>
                        </td>
                        <!-- Redirect to request details -->
                        <td><a href="<?php echo URLROOT . '/hms/requestDetails/' . $post->id; ?>" style="color: #0e4892"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End of Table -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>If the request is not resolved, "Resolved By" and "Resolved Date" will be empty.</h2>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo "<a class='pageee' href='http://localhost/juno/hms/seeHelp?page=" . $page . "'>" . $page . "</a> ";
            }
            ?>
        </div>
    </div>
</section>
<!-- End of See Customer Requests Page -->

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