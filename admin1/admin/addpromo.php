<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

if (isset($_POST['btn_save'])) {
    // Retrieve data from POST request
    $name = $_POST['name'];
    $price = $_POST['price'];
    $expired_at = $_POST['expired_at'];

    // Validation
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($name) > 50) {
        $errors[] = "Name cannot contain more than 50 characters";
    }

    if (empty($price)) {
        $errors[] = "Price is required";
    } elseif (!is_numeric($price)) {
        $errors[] = "Price must be a valid number";
    }

    if (empty($expired_at)) {
        $errors[] = "Expired At date is required";
    } elseif (!strtotime($expired_at)) {
        $errors[] = "Expired At must be a valid date";
    }

    // If no errors, insert data into the database
    if (count($errors) == 0) {
        // Prepare the SQL statement
        $stmt = $con->prepare("INSERT INTO `promocode`(`name`, `price`, `expired_at`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $price, $expired_at);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to promo.php on success
           @header("location:promo.php");
            exit();
        } else {
            // Handle error
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        mysqli_close($con);
    }
}
?>

<!-- Form UI -->
<div class="content">
  <div class="container-fluid">
    <div class="col-md-12">

    <div class="float-right">
                <!-- <a href="addpromo.php" class="btn btn-success">Add Promo Code</a> -->
                <a href="promo.php" class="btn btn-primary">Back</a>
                <br><br><br>
            </div>

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Add Promo Code</h4>
            <p class="card-category">Complete Promo Code Details</p>
          </div>
          <div class="card-body">
            <form action="" method="post" name="form" enctype="multipart/form-data">
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <?php if (isset($errors) && in_array("Name is required", $errors)) { ?>
                        <span style="color: red;">Name is required</span>
                    <?php } elseif (isset($errors) && in_array("Name must have at least 3 characters", $errors)) { ?>
                        <span style="color: red;">Name must have at least 3 characters</span>
                    <?php } elseif (isset($errors) && in_array("Name cannot contain more than 50 characters", $errors)) { ?>
                        <span style="color: red;">Name cannot contain more than 50 characters</span>
                    <?php } ?>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Price</label>
                    <input type="text" name="price" id="price" class="form-control">
                    <?php if (isset($errors) && in_array("Price is required", $errors)) { ?>
                        <span style="color: red;">Price is required</span>
                    <?php } elseif (isset($errors) && in_array("Price must be a valid number", $errors)) { ?>
                        <span style="color: red;">Price must be a valid number</span>
                    <?php } ?>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Expired At</label>
                    <input type="date" name="expired_at" id="expired_at" class="form-control">
                    <?php if (isset($errors) && in_array("Expired At date is required", $errors)) { ?>
                        <span style="color: red;">Expired At date is required</span>
                    <?php } elseif (isset($errors) && in_array("Expired At must be a valid date", $errors)) { ?>
                        <span style="color: red;">Expired At must be a valid date</span>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Save Promo Code</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
