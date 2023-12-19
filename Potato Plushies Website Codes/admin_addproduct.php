<?php

include 'db.php';

session_start();

if (isset($_POST['add_product_details'])) {
    $product_name = $_POST['name'];
    $product_name = filter_var($product_name, FILTER_SANITIZE_STRING);
    $product_price = $_POST['price'];
    $product_price = filter_var($product_price, FILTER_SANITIZE_STRING);
    $product_description = $_POST['details'];
    $product_description = filter_var($product_description, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_folder = '../uploaded_img/' . $image;

    $select_product_details = $conn->prepare("SELECT * FROM `product_details` WHERE product_name = ?");
    $select_product_details->bind_param("s", $product_name);
    $select_product_details->execute();
    $select_product_details->store_result();

    if ($select_product_details->num_rows > 0) {
        $message[] = 'Product name already exists!';
    } else {
        $insert_product_details = $conn->prepare("INSERT INTO `product_details` (product_name, product_description, product_price, image) VALUES (?,?,?,?)");
        $insert_product_details->bind_param("ssss", $product_name, $product_description, $product_price, $image);
        $insert_product_details->execute();

        if ($insert_product_details) {
            if ($image_size > 2000000000) {
                $message[] = 'Image size is too large!';
            } else {
                move_uploaded_file($_FILES['image']['tmp_name'], $image_folder);
                $message[] = 'New product added!';
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `product_details` WHERE id = ?");
    $delete_product_image->bind_param("i", $delete_id);
    $delete_product_image->execute();
    $fetch_delete_image = $delete_product_image->get_result()->fetch_assoc();

    // Update these lines to match your actual image columns in the database
    unlink('../uploaded_img/' . $fetch_delete_image['image']);

    $delete_product = $conn->prepare("DELETE FROM `product_details` WHERE id = ?");
    $delete_product->bind_param("i", $delete_id);
    $delete_product->execute();

    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->bind_param("i", $delete_id);
    $delete_cart->execute();

    header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

<style>
/* Reset some default styles */
body, h1, h2, p, ul, li {
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Arial', sans-serif;
}

/* Global Styles */
.container {
  width: 80%;
  margin: 0 auto;
}

/* Navigation Styles */
.topnav {
  background-color: #333;
  overflow: hidden;
}

.topnav a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Greetings Styles */
.greetings {
  width: 500px;
  margin: 200px auto;
  color: white;
  text-align: center;
}

/* Products Styles */
.box-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: space-around;
}

.box {
  width: 300px;
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
  margin-bottom: 20px;
}

.box img {
  width: 100%;
  height: auto;
  border-radius: 5px;
}

.product_name, .product_price, .product_details {
  margin-top: 10px;
}

.flex-btn {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.option-btn, .delete-btn {
  padding: 10px;
  border-radius: 5px;
  text-decoration: none;
  color: #fff;
  cursor: pointer;
}

.option-btn {
  background-color: #4CAF50;
}

.delete-btn {
  background-color: #f44336;
}

/* Add Products Styles */
.add-products {
  background-color: #ddd;
  padding: 20px;
  margin: 20px 0;
  border-radius: 10px;
}

.heading {
  text-align: center;
}

.flex {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.inputBox {
  flex: 1;
}

.box input, .box textarea {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.btn {
  background-color: #2196F3;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .container {
    width: 90%;
  }

  .box {
    width: 100%;
  }
}

</style>

</head>
<body>


<section class="add-products">

   <h1 class="heading">add product</h1>

   <form action="" method="post" enctype="multipart/form-data">
    <div class="flex">
        <div class="inputBox">
            <span>product name (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
        </div>
        <div class="inputBox">
            <span>product price (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
        </div>
        <div class="inputBox">
            <span>product stock (required)</span>
            <input type="number" min="0" class="box" required max="999999999" placeholder="enter product stock" onkeypress="if(this.value.length == 9) return false;" name="stock">
        </div>
        <div class="inputBox">
            <span>image 01 (required)</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>product details (required)</span>
            <textarea name="details" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
        </div>
    </div>
    <input type="submit" value="add product" class="btn" name="add_product">
</form>

</section>

<section class="show-products">

   <h1 class="heading">products added</h1>

   <div class="box-container">

   <?php
      $select_product_details = $conn->prepare("SELECT * FROM `product_details`");
      $select_product_details->execute();
      if ($select_product_details->num_rows() > 0) {
         while ($fetch_product_details = $select_product_details->fetch(PDO::FETCH_ASSOC)) {
   ?>
        <div class="box">
            <img src="../uploaded_img/<?= $fetch_product_details['image']; ?>" alt="">
            <div class="product_name"><?= $fetch_product_details['product_name']; ?></div>
            <div class="product_price">$<span><?= $fetch_product_details['product_price']; ?></span>/-</div>
            <div class="product_details"><span><?= $fetch_product_details['product_description']; ?></span></div>
            <div class="flex-btn">
                <a href="update_product.php?update=<?= $fetch_product_details['id']; ?>" class="option-btn">update</a>
                <a href="products.php?delete=<?= $fetch_product_details['id']; ?>"
                   class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
            </div>
        </div>
   <?php
         }
      } else {
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
   
   </div>

</section>
<!-- Defines a section for displaying existing products with a heading and a container for product boxes. -->

<script src="../js/admin_script.js"></script>
   
</body>
</html>