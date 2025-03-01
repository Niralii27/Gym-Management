<?php
session_start();
include("config.php");

// Pagination and searching variables
$search_query = "";
$records_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Searching
if (isset($_GET['search'])) {
    $search_query = " AND (Name LIKE '%" . mysqli_real_escape_string($con, $_GET['search']) . "%' OR name LIKE '%" . mysqli_real_escape_string($con, $_GET['search']) . "%')";
}

// Deleting record if action is delete
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $id = intval($_GET['id']); // Sanitize the input to ensure it's an integer
    mysqli_query($con, "DELETE FROM `attendance` WHERE id='$id'") or die("query is incorrect...");
}

// Fetch user_id of the selected record and all records for that user_id if action is show
$show_user_id = null;
$records = [];
if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
    $show_id = intval($_GET['id']); // Get the selected record ID
    // Fetch the user_id of the selected record
    $user_query = mysqli_query($con, "SELECT `user_id` FROM `attendance` WHERE `id`='$show_id'");
    if ($user_row = mysqli_fetch_assoc($user_query)) {
        $show_user_id = $user_row['user_id'];
        // Fetch all records for that user_id
        $result = mysqli_query($con, "SELECT `id`, `name`, `date`, `check_in_time`, `check_out_time`, `status` FROM `attendance` WHERE `user_id`='$show_user_id'");
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }
    }
}

// Fetch records for pagination
$result = mysqli_query($con, "SELECT `id`, `name`, `date`, `check_in_time`, `check_out_time`, `status` FROM `attendance` WHERE 1" . $search_query . " LIMIT $offset, $records_per_page");

include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="float-right">
                <a href="addattendance.php" class="btn btn-success">Add +</a>
                
                <br><br><br>
            </div>

            <div class="card">
                <div class="card-header card-header-primary">
                    <h2 class="card-title">Attendance List</h2>
                    <div class="float-right">
                        <form action="" method="get" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control search-input" placeholder="Search...">
                                <br><br>
                                <button type="submit" class="btn btn-primary">Search</button>

                                <?php if (isset($_GET['search'])) { ?>
                            <a href="manageuser.php" class="btn btn-default">Clear Search</a>
                        <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter table-hover" id="">
                            <thead class="text-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Check_in_Time</th>
                                    <th>Check_Out_Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                             $search_query = "";
                             if (isset($_GET['search'])) {
                                 $search_query = " AND (name LIKE '%" . mysqli_real_escape_string($con, $_GET['search']) . "%')";
                             }
                             
                               

                                $total_records = mysqli_num_rows(mysqli_query($con, "SELECT `id` FROM `attendance` WHERE 1" . $search_query));
                                $records_per_page = 5;
                                $total_pages = ceil($total_records / $records_per_page);

                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $records_per_page;

                                $result = mysqli_query($con, "SELECT `id`, `name`, `date`, `check_in_time`, `check_out_time`, `status` FROM `attendance` WHERE 1" . $search_query . " LIMIT $offset, $records_per_page");

                                while (list($id, $name, $date, $check_in_time, $check_out_time, $status) = mysqli_fetch_array($result)) {
                                    echo "<tr>
                                            <td>$id</td>
                                            <td>$name</td>
                                            <td>$date</td>
                                            <td>$check_in_time</td>
                                            <td>$check_out_time</td>
                                            <td>$status</td>";                                  

                                    echo "<td>
                                        

   
                                    <a href='manageuser.php?id=$id&action=show' class='text-info me-3' title='Show' style='margin-right: 15px;'>
                                           <i class='fa fa-eye fa-lg'></i>
                                       </a>

                                  
                                    
                                       <a href='edituser.php?id=$id' class='text-primary' title='Edit'  style='margin-right: 15px;'>
                                           <i class='fa fa-edit fa-lg'></i>
                                       </a>
                                       <a href='manageuser.php?id=$id&action=delete' class='text-danger' title='Delete' onclick='return confirm(\"Are you sure you want to delete this record?\")'>
                                           <i class='fa fa-trash fa-lg'></i>
                                       </a>
                                   </td>

                                   </tr>";

                            
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Pagination links -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($page <= 1) echo '#'; else echo "manageuser.php?page=" . ($page - 1) . (isset($_GET['search']) ? "&search=" . $_GET['search'] : ''); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li class="page-item <?php if ($page == $i) echo 'active'; ?>"><a class="page-link" href="manageuser.php?page=<?php echo $i; ?><?php if (isset($_GET['search'])) echo "&search=" . $_GET['search']; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($page >= $total_pages) echo '#'; else echo "manageuser.php?page=" . ($page + 1) . (isset($_GET['search']) ? "&search=" . $_GET['search'] : ''); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>

                    </div>
                </div>
            </div>
        </div>

        <!-- Show Records Section -->
        <?php if ($show_user_id): ?>
        <div class="card mt-4">
            <div class="card-header card-header-info">
                <h3 class="card-title">Attendance Records for User ID: <?php echo $show_user_id; ?></h3>
            </div>
            <div class="card-body">
                <table class="table tablesorter table-hover">
                    <thead class="text-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Check_in_Time</th>
                            <th>Check_Out_Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo $record['id']; ?></td>
                            <td><?php echo $record['name']; ?></td>
                            <td><?php echo $record['date']; ?></td>
                            <td><?php echo $record['check_in_time']; ?></td>
                            <td><?php echo $record['check_out_time']; ?></td>
                            <td><?php echo $record['status']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .search-input {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 300px;
    }

    .search-input::placeholder {
        color: #666;
        font-size: 16px;
    }

    .input-group {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .input-group .form-control {
        margin-right: 4px;
    }

    .input-group .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
    }

    .input-group .btn-primary {
        background-color: #337ab7;
        border-color: #337ab7;
        color: #fff;
    }

    .input-group .btn-default {
        background-color: #fff;
        border-color: #ccc;
        color: #666;
    }
</style>
<?php
include "footer.php";
?>
