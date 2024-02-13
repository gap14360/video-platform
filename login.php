<?php
    session_start();

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include your database connection
        include_once "db_connection.php";

        // Retrieve username and password from form
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Validate username and password (you can add more validation if needed)
        // Here, for simplicity, we're just checking if they're not empty
        if (!empty($username) && !empty($password)) {
            // You should sanitize and hash the password before storing it in the database
            // For demonstration purpose, let's assume the password is already hashed

            // Query the database to check if the username and password match
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                // If login is successful, set session variables and redirect to upload page
                $_SESSION["username"] = $username;
                header("Location: upload_video.php");
                exit();
            } else {
                // If login fails, redirect back to login page with error message
                $_SESSION["error"] = "Invalid username or password.";
                header("Location: login.php");
                exit();
            }
        } else {
            // If username or password is empty, redirect back to login page with error message
            $_SESSION["error"] = "Username and password are required.";
            header("Location: login.php");
            exit();
        }
    } else {
        // If user accesses this page without submitting the form, redirect to login page
        header("Location: login.php");
        exit();
    }
?>
