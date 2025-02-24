<?php
session_start();
include("config.php");

if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $created_at = date("Y-m-d H:i:s");

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
    } elseif (strlen($name) > 50) { // Updated character limit for 'Name'
        $errors[] = "Name cannot exceed 50 characters";
    }

    // Description validation
    if (empty($description)) {
        $errors[] = "Description is required";
    }

    // Picture validation
    if (empty($picture_name)) {
        $errors[] = "Image is required";
    } elseif (!in_array($picture_type, ["image/jpeg", "image/jpg", "image/png", "image/gif"])) {
        $errors[] = "Invalid file type. Only JPG, PNG, GIF are allowed.";
    } elseif ($picture_size > 5000000) { // Limit the size to 5MB for better control
        $errors[] = "File size should be less than 5MB.";
    }

    if (count($errors) == 0) {
        // Sanitize the file name to remove special characters and prevent directory traversal
        $base_name = pathinfo($picture_name, PATHINFO_FILENAME);
        $base_name = preg_replace("/[^a-zA-Z0-9_-]/", "", $base_name);
        $file_extension = pathinfo($picture_name, PATHINFO_EXTENSION);
        $pic_name = $base_name . '.' . $file_extension;

        // Ensure the upload directory exists
        $upload_dir = __DIR__ . "/assets/img/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }

        // Move the uploaded file
        if (move_uploaded_file($picture_tmp_name, $upload_dir . $pic_name)) {
            // Insert into classes table
            $insert_query = "INSERT INTO `classes` (`id`, `Name`, `description`, `img`, `created_at`) 
                             VALUES (NULL, '$name', '$description', '$pic_name', '$created_at')";
            mysqli_query($con, $insert_query);

            header("location: classes.php");
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
                <a href="addclasses.php" class="btn btn-success">Add +</a>
                <a href="classes.php" class="btn btn-primary">Back</a>
                <br><br><br>
            </div>
                    <div class="card">
                        
                        <div class="card-header card-header-primary">
                            <h5 class="title">Add Class</h5>
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
                                        <?php } elseif (isset($errors) && in_array("Name cannot exceed 50 characters", $errors)) { ?>
                                            <span style="color: red;">Name cannot exceed 50 characters</span>
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
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Add Class</button>
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
