<?php
@include 'config.php';

session_start(); // Start the session

// Unset and destroy session data
session_unset();
session_destroy();

// Prevent caching of the page to avoid back-button issues
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// JavaScript to prevent back button after logout
echo "<script>
    // Prevent back navigation
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
    // Apply the function as soon as the page loads
    window.onload = function() {
        setTimeout('noBack()', 0);
    }
</script>";

// Redirect to the login page after logout
header('Location: http://localhost/fox/login_form.php');
exit(); // Make sure the script stops after redirect
?>
