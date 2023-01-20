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

<!-- See Restaurant Bookings Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-see-message"><i class="fas fa-utensils"></i> &nbsp; Restaurant Reservations</h2>
        <!-- Searchbox -->
        <div class="search-box">
            <input type="text" id="filter" onkeyup="filter()" class="search" placeholder="Search...">
            <i class="fas fa-search"></i>
        </div>

        <!-- Table -->
        <table id="table">
            <thead>
                <tr class="header">
                    <th>Client Name</th>
                    <th>Number of People</th>
                    <th>Day</th>
                    <th>Hour</th>
                    <th>Archive</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td><?php echo $post->clientName; ?></td>
                        <td><?php echo $post->nrPpl; ?></td>
                        <td>
                            <?php
                            $day = date_create($post->day);
                            echo date_format($day, 'M d, Y');
                            ?>
                        </td>
                        <td><?php echo $post->hour; ?></td>
                        <td>
                            <!-- Archive Reservation -->
                            <form action="<?php echo URLROOT . '/hms/seeRestaurantReservation/'; ?>" method="POST">
                                <input type="hidden" name="id" value="<?php echo $post->id; ?>">
                                <input type="submit" name="archiveRest" value="Archive" style="background: transparent; outline: none; border: none; cursor: pointer; color: #f94144; font-weight: bold;">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End of Table -->

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo "<a class='pageee' href='http://localhost/juno/hms/seeRestaurantReservation?page=" . $page . "'>" . $page . "</a> ";
            }
            ?>
        </div>
    </div>
</section>
<!-- End of See Restaurant Bookings Page -->

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