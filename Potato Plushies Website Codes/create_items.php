<?php

include('db.php');

if(isset($_POST['add_data'])){

$name = $_POST['product_name'];
$price = $_POST['product_price'];
$status = $_POST['product_status'];
$desc = $_POST['product_description'];
$image = $_POST['image'];


//Creates Item
$stmt = $conn->prepare("INSERT INTO product_details (product_name,product_price,product_description,image,product_status)
                              VALUES (?,?,?,?,?)");

$stmt->bind_param('sssss', $name, $price, $desc, $image, $status);

if($stmt->execute()){
    header('location: adminpage.php?message=Item has been Added');
}else{
    header('location: adminpage.php?error=Error Occured');
}



}