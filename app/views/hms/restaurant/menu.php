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

<!-- See Menu Items Page -->
<section class="index">
    <div class="content-box column">
        <!-- Create Menu Item Button and Page Title -->
        <div class="title-create">
            <h2 style="margin-right: 1.5rem;"><i class="fas fa-utensils"></i> &nbsp; Menu</h2>
            <a href="<?php echo URLROOT; ?>/hms/addMenuItem" class="create-btn"><i class="fas fa-plus-circle"></i> &nbsp; Add Menu Item</a>
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
                    <th>Name</th>
                    <th>Price</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td><?php echo $post->name; ?></td>
                        <td><?php echo '$ ' . $post->price; ?></td>
                        <td><a href="<?php echo URLROOT . '/hms/menuDetails/' . $post->id; ?>" style="color: #0e4892"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End of Table -->

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo "<a class='pageee' href='http://localhost/juno/hms/seeMenu?page=" . $page . "'>" . $page . "</a> ";
            }
            ?>
        </div>
    </div>
</section>
<!-- End of See Menu Items Page -->

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