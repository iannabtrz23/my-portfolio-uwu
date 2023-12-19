<?php
session_start();
include('db.php');

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Retrieve user ID from the session
$userId = $_SESSION['user_id'];

// Retrieve user's order tracking details from the database
$get_order_details = "SELECT o.order_id, p.product_price, p.product_name, o.date_ordered FROM orders o
JOIN product_details p 
on p.product_id = o.product_id 
WHERE user_id = '$userId'";
$result = mysqli_query($conn, $get_order_details);

if (!$result) {
    die("Error fetching order details: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Order Tracking</title>
    <style>
        /* Your CSS styles for displaying order tracking information */
        /* CSS for User Order Tracking Page */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

/* Styling for the 'Back to Homepage' link */
a {
    display: block;
    text-align: center;
    margin-top: 20px;
    text-decoration: none;
    color: #3498db;
}

a:hover {
    color: #2980b9;
}
        /* Add your styles here */
    </style>
</head>
<body>
    <h2>User Order Tracking</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Date Ordered</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>PHP <?php echo $row['product_price']; ?></td>
                    <td><?php echo $row['date_ordered']; ?></td>
                    <!-- Display additional order tracking details -->
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="homepage.php">Back to Homepage</a>
</body>
</html>
