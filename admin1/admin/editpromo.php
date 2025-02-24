<?php
session_start();
include("config.php");

$id = $_REQUEST['id'];

// Fetch the current data from the 'products' table
$result = mysqli_query($con, "SELECT `id`, `name`, `price`, `created_at`, `expired_at` FROM `promocode` WHERE id='$id'") or die("Query 1 incorrect.......");

list($id, $name, $price, $created_at, $expired_at) = mysqli_fetch_array($result);

if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    $expired_at = $_POST['expired_at'];

    // Validate required fields
    if (empty($name) || empty($price) || empty($created_at) || empty($expired_at)) {
        // $error = "All fields are required.";
    } else {
        // Update the record
        $update_query = "UPDATE `promocode` SET 
                            `name`='$name', 
                            `price`='$price', 
                            `created_at`='$created_at', 
                            `expired_at`='$expired_at' 
                        WHERE id='$id'";
        if (mysqli_query($con, $update_query)) {
            header("location: promo.php");
            mysqli_close($con);
            exit();
        } else {
            die("Query 2 is incorrect..........");
        }
    }
}

include "sidenav.php";
include "topheader.php";
?>

<!-- Form for Editing Fields -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" onsubmit="return validateForm()">
            <div class="row">
                <div class="col-md-12">

                    <div class="float-right">             
                        <a href="promo.php" class="btn btn-primary">Back</a>
                        <br><br><br>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Edit Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Name Field -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control">
                                        <span id="nameError" style="color: red;"></span>
                                    </div>
                                </div>

                                <!-- Price Field -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" id="price" name="price" value="<?php echo $price; ?>" class="form-control">
                                        <span id="priceError" style="color: red;"></span>
                                    </div>
                                </div>

                               

                                <!-- Expired At Field -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Expired At</label>
                                        <input type="date" id="expired_at" name="expired_at" value="<?php echo $expired_at; ?>" class="form-control">
                                        <span id="expiredAtError" style="color: red;"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Error Message -->
                            <?php if (isset($error)) { ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php } ?>

                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update Product</button>
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

<!-- JavaScript Validation -->
<script>
    function validateForm() {
        let isValid = true;

        // Name validation
        let name = document.getElementById('name').value;
        if (name === "" || name.length < 3 || name.length > 50) {
            document.getElementById('nameError').innerText = "Name must be between 3 and 50 characters.";
            isValid = false;
        } else {
            document.getElementById('nameError').innerText = "";
        }

        // Price validation
        let price = document.getElementById('price').value;
        if (price === "" || price <= 0) {
            document.getElementById('priceError').innerText = "Price must be a positive number.";
            isValid = false;
        } else {
            document.getElementById('priceError').innerText = "";
        }

     

        // Expired At validation
        let expiredAt = document.getElementById('expired_at').value;
        if (expiredAt === "") {
            document.getElementById('expiredAtError').innerText = "Expired At date is required.";
            isValid = false;
        } else {
            document.getElementById('expiredAtError').innerText = "";
        }

        return isValid;
    }
</script>
