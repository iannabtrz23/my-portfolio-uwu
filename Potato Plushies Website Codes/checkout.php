<?php
session_start();
include('db.php');

// Check if the user is logged in (you may need to implement user authentication)
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$userId = $_SESSION['username'];
// Check if the cart is not empty
if (!empty($_SESSION['cart'])) {

    // Insert order details into the orders table
    $dateOrdered = date('Y-m-d H:i:s');
    $orderStatus = 'Pending'; // You can set an initial order status
    $userId = $_SESSION['user_id'];
    $query = "INSERT INTO orders (user_id, product_id, date_ordered, order_status) VALUES (?, ?, ?, ?)";

    foreach ($_SESSION['cart'] as $cartItem) {
        $productId = $cartItem['id'];
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiss", $userId, $productId, $dateOrdered, $orderStatus);
        $stmt->execute();
        $stmt->close();
    }

    // Clear the cart after placing the order
    unset($_SESSION['cart']);

    // Redirect to a confirmation page or display a success message
    header("Location: order_confirmation.php");
    exit();
} else {
    // Redirect to the homepage or display an error message if the cart is empty
    header("Location: homepage.php");
    exit();
}
?>

<!-- Display a link to view order tracking -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content -->
</head>
<body>
    <!-- Your existing HTML content -->

    <?php if (!empty($_SESSION['cart'])) : ?>
        <!-- Display a link to view order tracking -->
        <p>Your order has been placed successfully!</p>
        <a href="order_tracking.php">View Order Tracking</a>
    <?php endif; ?>