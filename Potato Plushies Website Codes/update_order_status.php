<?php

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

   
    $update_query = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $update_query->bind_param('ss', $order_status, $order_id);
    
    if ($update_query->execute()) {
        header("Location: adminpage.php");
        exit();
    } else {
        echo "Error updating order status: " . $conn->error;
    }

    $update_query->close();
}

$conn->close();