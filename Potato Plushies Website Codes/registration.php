<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_firstname = $_POST["user_firstname"];
    $user_lastname = $_POST["user_lastname"];
    $username = $_POST["username"];
    $contact_number = $_POST["contact_number"];
    $user_address = $_POST["user_address"];
    $email_address = $_POST["email_address"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // check kading password
    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match.";
        exit(); // Stop execution if passwords do not match
    }

    $sql = "INSERT INTO users_details (user_firstname, user_lastname, username, contact_number, user_address, email_address, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $user_firstname, $user_lastname, $username, $contact_number, $user_address, $email_address, $password);

    if ($stmt->execute()) {
        // pag naka register kana idi malipat kadi sa login
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>