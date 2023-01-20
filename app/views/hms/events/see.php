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

<!-- See Internal Events Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-see-message"><i class="fas fa-calendar-day"></i> &nbsp; Internal Events</h2>
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
                    <th>Date</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td><?php echo $post->eventName; ?></td>
                        <td>
                            <?php
                            $eventDate = date_create($post->eventDate);
                            echo date_format($eventDate, 'M d, Y');
                            ?>
                        </td>
                        <td><?php echo $post->eventDescription; ?></td>
                        <td><?php echo ucfirst($post->eventStatus); ?></td>
                        <?php if ($post->eventStatus == "unresolved") : ?>
                            <!-- Resolve Event -->
                            <td><a href="<?php echo URLROOT . '/hms/resolveEvent/' . $post->id; ?>" style="color: #0e4892">Resolve</a></td>
                        <?php else : ?>
                            <td>
                                <!-- Archive Event -->
                                <form action="<?php echo URLROOT . '/hms/seeEvent/'; ?>" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $post->id; ?>">
                                    <input type="submit" name="archiveEvent" value="Archive" style="background: transparent; outline: none; border: none; cursor: pointer; color: #f94144; font-weight: bold;">
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End of Table -->

        <!-- Page Text Details -->
        <div class="page-details">
            <div class="message">
                <i class="fas fa-asterisk"></i>
                <h2>Only resolved events can be archived.</h2>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo "<a class='pageee' href='http://localhost/juno/hms/seeEvent?page=" . $page . "'>" . $page . "</a> ";
            }
            ?>
        </div>
    </div>
</section>
<!-- End of See Internal Events Page -->

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