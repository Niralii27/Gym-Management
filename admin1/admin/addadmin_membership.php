<?php
session_start();
include("config.php");

if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $time_duration = $_POST['time_duration'];
    $date = $_POST['date'];

    // Picture uploading
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    // Validation
    $errors = array();

    // Name validation
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($name) > 20) {
        $errors[] = "Name cannot exceed 20 characters";
    }

    // Amount validation
    if (empty($amount)) {
        $errors[] = "Amount is required";
    } elseif (!is_numeric($amount)) {
        $errors[] = "Amount must be a number";
    }

    // Description validation
    if (empty($description)) {
        $errors[] = "Description is required";
    }

    // Time duration validation
    if (empty($time_duration)) {
        $errors[] = "Time duration is required";
    }

    // Date validation
    if (empty($date)) {
        $errors[] = "Date is required";
    }

    // Picture validation
    if (empty($picture_name)) {
        $errors[] = "Image is required";
    } elseif (!in_array($picture_type, ["image/jpeg", "image/jpg", "image/png", "image/gif"])) {
        $errors[] = "Invalid file type. Only JPG, PNG, GIF are allowed.";
    } elseif ($picture_size > 50000000) {
        $errors[] = "File size should be less than 50MB.";
    }

   if (count($errors) == 0) {
    // Get the file extension
    $file_extension = pathinfo($picture_name, PATHINFO_EXTENSION);

    // Sanitize the file name to prevent issues with special characters
    $base_name = pathinfo($picture_name, PATHINFO_FILENAME);
    $base_name = preg_replace("/[^a-zA-Z0-9_-]/", "", $base_name);

    // Reconstruct the file name
    $pic_name = $base_name . '.' . $file_extension;

    // Ensure the directory path is valid
    $upload_path = __DIR__ . "/images/";

    // Move the uploaded file to the desired location
    if (move_uploaded_file($picture_tmp_name, $upload_path . $pic_name)) {
        // Insert into the database
        mysqli_query($con, "INSERT INTO `admin_membership` (`id`, `Name`, `Amount`, `Image`, `Description`, `Time_duration`, `Date`) 
            VALUES (NULL, '$name', '$amount', '$pic_name', '$description', '$time_duration', '$date')");
        
        header("location: admin_membership.php");
        mysqli_close($con);
    } else {
        $errors[] = "Failed to upload image.";
    }
}
}

    
include "sidenav.php";
include "topheader.php";
?>

<!-- Form -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right">
                        
                        <a href="admin_membership.php" class="btn btn-primary">Back</a>
                        <br><br><br>
                    </div>
                    
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Add Admin Membership</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                        <?php if (isset($errors) && in_array("Name is required", $errors)) { ?>
                                            <span style="color: red;">Name is required</span>
                                        <?php } elseif (isset($errors) && in_array("Name must have at least 3 characters", $errors)) { ?>
                                            <span style="color: red;">Name must have at least 3 characters</span>
                                        <?php } elseif (isset($errors) && in_array("Name cannot exceed 20 characters", $errors)) { ?>
                                            <span style="color: red;">Name cannot exceed 20 characters</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" id="amount" name="amount" class="form-control">
                                        <?php if (isset($errors) && in_array("Amount is required", $errors)) { ?>
                                            <span style="color: red;">Amount is required</span>
                                        <?php } elseif (isset($errors) && in_array("Amount must be a number", $errors)) { ?>
                                            <span style="color: red;">Amount must be a number</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="4" cols="80" id="description" name="description" class="form-control"></textarea>
                                        <?php if (isset($errors) && in_array("Description is required", $errors)) { ?>
                                            <span style="color: red;">Description is required</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Time Duration</label>
                                        <input type="text" id="time_duration" name="time_duration" class="form-control">
                                        <?php if (isset($errors) && in_array("Time duration is required", $errors)) { ?>
                                            <span style="color: red;">Time duration is required</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Add Image</label><br>
                                        <input type="file" name="picture" class="btn btn-fill btn-success" id="picture"><br>
                                        <?php if (isset($errors) && in_array("Image is required", $errors)) { ?>
                                            <span style="color: red;">Image is required</span>
                                        <?php } elseif (isset($errors) && in_array("Invalid file type. Only JPG, PNG, GIF are allowed.", $errors)) { ?>
                                            <span style="color: red;">Invalid file type. Only JPG, PNG, GIF are allowed.</span>
                                        <?php } elseif (isset($errors) && in_array("File size should be less than 50MB.", $errors)) { ?>
                                            <span style="color: red;">File size should be less than 50MB.</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" id="date" name="date" class="form-control">
                                        <?php if (isset($errors) && in_array("Date is required", $errors)) { ?>
                                            <span style="color: red;">Date is required</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Add Membership</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include "footer.php";
?>
