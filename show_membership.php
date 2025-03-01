<?php
include('header.php');
include('config.php'); // Ensure this file connects to your database

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if not already started
}
$user_id = $_SESSION['id']; // Replace with your actual session variable

// Query to fetch data from the user_membership table
$query = "SELECT * FROM user_membership WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<style>

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #ffffff;
        }

       .membership-card {
    color: rgba(255, 255, 255, 0.9); /* Light text color */
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center; /* Center alignment */
    background-color: rgba(0, 0, 0, 0.5); /* Transparent black background */
    border: 1px solid rgba(255, 255, 255, 0.2); /* Optional border for better visibility */
}


        .membership-card h3 {
            font-size: 24px;
            color: #fffff;
            margin-bottom: 10px;
        }

        .membership-card p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }

        .add-membership-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-membership-btn:hover {
            background-color: #0056b3;
        }
    </style>
  </head>
<body>
<div class="container">
<br>
</br>
    <h1>User Memberships</h1>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="membership-card">
                <h3><?php echo htmlspecialchars($row['Name']); ?> Membership</h3>
                <p><strong>Starting Date:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>
                <p><strong>Amount:</strong> ₹<?php echo htmlspecialchars($row['Amount']); ?></p>
            </div>
            <?php
        }
    } else {
        echo "<p style='text-align: center;'>No memberships found.</p>";
    }
    ?>
    <div style="text-align: center;">
        <a href="plan.php" class="add-membership-btn">Add New Membership</a>
    </div>
</div>
        </section>
  </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

   <script>
        $(document).ready(function () {
            $("#profile-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    number: {
                        required: true,
                        number: true,
                        minlength: 10
                    },
                    weight: {
                        required: true,
                        number: true,
                        min: 1
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Your name must consist of at least 3 characters"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    number: {
                        required: "Please enter your number",
                        number: "Please enter a valid number",
                        minlength: "Your number must be at least 10 digits long"
                    },
                    weight: {
                        required: "Please enter your weight",
                        number: "Please enter a valid weight",
                        min: "Weight must be greater than 0"
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.next('.error'));
                }
            });
 $("#transparent-form1").on("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting
            alert("Your class has been removed successfully!");
	});
        });
    </script>




<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/wow.js"></script>
<script src="js/main.js"></script>

  <?php include('footer.php'); ?>
</body>
</html>
