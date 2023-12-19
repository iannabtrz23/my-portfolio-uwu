<?php
session_start();
include('db.php'); // Assuming this file contains your database connection logic

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute a query to check user credentials
    $sql = "SELECT * FROM users_details WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Retrieve user information
        $user = $result->fetch_assoc();

        // Login successful
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['user_id'];
        // Check the user type and redirect accordingly
        if ($user['user_type'] === 'A') {
            header('location: adminpage.php'); // Redirect to admin page
            exit();
        } else if ($user['user_type'] === 'U') {
            header('location: homepage.php'); // Redirect to user page
            exit();
        } else {
            header('location: login.php?error=404'); // Redirect to error page
            exit();
        }
    } else {
        // Login failed
        echo "<p>Login failed. Invalid credentials.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="login.css">
    <title>Potato Plushies Login</title>
</head>
<body>
    <!-- Experiment lang testing testing start -->
    <div class="content">
        <h1>Potato<br>Plushies</h1>
        <p>Cuddle up with our perfect companions for cozy moments of comfort and joy. </p>
    </div>
    <!-- Experiment lang testing testing end -->
    <div class="login-page">
        <div class="form">
            <div class="login">
                <div class="login-header">
                    <h3>LOGIN HERE</h3>
                    <p>Please enter your details to login.</p>
                </div>
            </div>
            <form class="login-form"  method="post">
                <input type="text" name="username" placeholder="username"/>
                <input type="password" name="password" placeholder="password"/>
                <button type="submit" name="login">login</button>
                <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
            </form>
        </div>
    </div>
    <!-- Add nalang ulit pag naayos -->
    <!-- <footer>
        <p>&copy; 2023 Potato Plushies</p>
    </footer> -->
</body>
</html>
