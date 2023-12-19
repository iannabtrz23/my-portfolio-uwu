<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Check if the order ID is set in the session
if (isset($_SESSION['order_id'])) {
    $orderId = $_SESSION['order_id'];
  

   
    unset($_SESSION['order_id']);
} else {

    header("Location: homepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>

<h2>Order Confirmation</h2>

<p>Thank you for your order! Your order has been successfully placed.</p>


<p>Order ID: <?php echo $orderId; ?></p>


<p><a href="homepage.php">Continue Shopping</a></p>

</body>
</html>