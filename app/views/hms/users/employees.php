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

<!-- See Employees Page -->
<section class="index">
    <div class="content-box column">
        <!-- Create Employee Button and Page Title -->
        <div class="title-create">
            <h2 style="margin-right: 1.5rem;"><i class="fas fa-users"></i> &nbsp; Employee list.</h2>
            <a href="<?php echo URLROOT; ?>/hms/createEmployee" class="create-btn"><i class="fas fa-plus-circle"></i> &nbsp; Employee</a>
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
                    <th>Role</th>
                    <th>Employeed On</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td><?php echo $post->firstName . "  " . $post->lastName; ?></td>
                        <td><?php echo $post->role; ?></td>
                        <td>
                            <?php
                            $employeed = date_create($post->employeedOn);
                            echo date_format($employeed, "D, M d, Y");
                            ?>
                        </td>
                        <!-- Delete Employee Btn -->
                        <td><a href="<?php echo URLROOT . '/hms/deleteEmployee/' . $post->id; ?>" style="color: #d9534f;" onclick="return confirm('Are you sure you want to delete this employee ? ');"><i class=" fas fa-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End of Table -->

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo "<a class='pageee' href='http://localhost/juno/hms/employees?page=" . $page . "'>" . $page . "</a> ";
            }
            ?>
        </div>
    </div>
</section>
<!-- End of See Employees Page -->

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