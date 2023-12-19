<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $size = $_POST['size'];
    $material = $_POST['material'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];

    // Process the order (store it in a text file for this example)
    $orderDetails = "Size: $size\nMaterial: $material\nColor: $color\nQuantity: $quantity\n\n";

    // Save order details to a text file
    $file = 'orders.txt';
    file_put_contents($file, $orderDetails, FILE_APPEND | LOCK_EX);

    // Display a success message
    echo "<h2>Order Placed Successfully!</h2>";
    echo "<p>Thank you for your order.</p>";

    // You can redirect the user to a confirmation page or perform other actions as needed
} else {
    // Redirect if accessed directly
    header("Location: index.html");
    exit();
}
?>
