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

<!-- See Users List Page -->
<section class="index">
    <div class="content-box column">
        <h2 class="home-see-message"><i class="fas fa-users"></i> &nbsp; Users List</h2>
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
                    <th>Username</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <td><?php echo $post->firstName . " " . $post->lastName; ?></td>
                        <td><?php echo $post->role; ?></td>
                        <td><?php echo $post->username; ?></td>
                        <td><?php echo $post->createdBy; ?></td>
                        <td>
                            <?php
                            $created = date_create($post->createdOn);
                            echo date_format($created, 'M d, Y');
                            ?>
                        </td>
                        <!-- Redirect to Edit User -->
                        <td><a href="<?php echo URLROOT . '/hms/editUser/' . $post->id; ?>" style="color: #6BBF59;"><i class="fas fa-edit"></i></a></td>

                        <!-- Delete User -->
                        <td><a href="<?php echo URLROOT . '/hms/deleteUser/' . $post->id; ?>" style="color: #d9534f;" onclick="return confirm('Are you sure you want to delete this user? ');"><i class=" fas fa-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End of Table -->

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($page = 1; $page <= $numberOfPages; $page++) {
                echo "<a class='pageee' href='http://localhost/juno/hms/seeUsers?page=" . $page . "'>" . $page . "</a> ";
            }
            ?>
        </div>
    </div>
</section>
<!-- End of See Users List Page -->

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