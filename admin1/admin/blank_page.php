<?php
// Start the session
session_start();

// Check if the session is not set (user not logged in)
if (!isset($_SESSION['admin_name'])) {
    // You can show this message if the user is not logged in
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Oops</title>
        <style>
            /* Full page height */
            body, html {
                height: 100%;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f4f4f4;
                font-family: Arial, sans-serif;
            }

            /* Centering the message box */
            .message-box {
                text-align: center;
                padding: 20px;
                background-color: #ffeb3b;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .message-box h2 {
                color: #ff5722;
            }

            .message-box p {
                font-size: 16px;
                color: #333;
            }

            /* You can add a button to log out or take action */
            .logout-btn {
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #2196f3;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-decoration: none;
            }

            .logout-btn:hover {
                background-color: #1976d2;
            }
        </style>
    </head>
    <body>

        <div class='message-box'>
            <h2>Oops, You can Logout</h2>
            <p>You are not logged in, please log in to continue.</p>
            <a href='logout.php' class='logout-btn'>Logout</a>
        </div>

    </body>
    </html>";
    exit();
}
?>
