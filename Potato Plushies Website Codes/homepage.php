<?php
session_start(); // Initializes a session or resumes the current session.
include ('db.php');

// Check if the user is logged in (you may need to implement user authentication)
if (!isset($_SESSION['username'])) {
  header("Location: login.php"); // Redirect to login page if not logged in
  exit();
}

// Logout logic. If the 'logout' button is pressed, it unsets all session variables, destroys the session, and redirects the user to the login page.
if (isset($_POST['logout'])) {
  // Unset all session variables
  session_unset();
  
  // Destroy the session
  session_destroy();
  
  // Redirect to the homepage or login page
  header("Location: login.php"); // Change the destination accordingly
  exit();
}

// Initialize $_SESSION['cart'] as an empty array if not set. Handles adding items to the cart when the 'Add to cart' button is pressed.
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding items to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];

    // Add item to the cart
    $cartItem = ['name' => $itemName, 'price' => $itemPrice];
    $_SESSION['cart'][] = $cartItem;
}

// Handle the "View Cart" button click
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_cart'])) {
    // Redirect to cart.php
    header("Location: cart.php");
    exit();
}
?>

<?php

$stmt = $conn->prepare("SELECT * FROM product_details" );

$stmt->execute();

$items = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <title>Homepage</title>

<style>

*{
padding: 0;
margin: 0;
box-sizing: border-box;

}

/* -------------NAVIGATION---------------*/
.bg-img{
  background-image: url("homepageimg.jpg");
  min-height: 700px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}




.topnav {
  overflow: hidden;
}


.topnav a, .cart_nav{
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  font-family: 'Arial';
  margin-top: 10px;

}

.topnav a:hover {
  background-color: rgb(176, 136, 213);
  color: black;
}

.cart_nav{
  border-style:none;
  background-color: transparent;
}
.cart_nav:hover {
  background-color: rgb(176, 136, 213);
  color: black;
}

.search{
  position: relative;
}

/* -------------Greetings---------------*/
.greetings{
  width: 500px;
  position: relative;
  margin-top: 200px;
  margin-left: 100px;
  color:white;
}

.intro-details{
  margin-top: 8px;
  color: white;
}


/* -------------Products---------------*/

.wrapper{
  background-color: blanchedalmond;
}





  .product-image{
    width: 300px;
}

.add-to-cart-btn{
  padding: 10px;
  padding-left: 15px;
  padding-right: 15px;
  background-color: rgb(139, 208, 211);
  color: white;
  border-style: none;
  border-radius: 20px;
  font-size: 15px;
}

.add-to-cart-btn:hover{
  opacity: 0.8;
}

.add-to-cart-btn:active{
  opacity: 0.5;
}

div p {
  font-family: 'Arial';
  color: rgba(72, 56, 56, 0.999);
  
}
</style>
</head>



<body> 
  
<!---------NAVIGATION BAR------------------------------------------->
<div class="bg-img">
    <div class="container">
      <div class="topnav">
        <a href="#home">Home</a>
        <form method="post" action="cart.php">
                <button class="cart_nav" type="submit" name="view_cart">Cart</button>
        </form>
        <a href="order_tracking.php">My Orders</a>
        <a href="#about">About</a>

               <!-- Add the logout form -->
               <form method="post">
          <button class="cart_nav" type="submit" name="logout">Logout</button>
        </form>

      </div>
    </div>

    <div class="greetings">
      <h1>Welcome to Potato Plushies! </h1>
      <p class="intro-details">Welcome to our soft and dcozy corner! Explore our collection of plush pillows and luxurious blankets to add comfort and warmth to your home. </p>
    </div>

</div>


<!-------ITEM---------------ITEMS----ITEM-----------ITEMs--------------------->
<section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Products</h3>
    </div>

    <div class="row mx-auto container-fluid">
        <?php while ($row = $items->fetch_assoc()) { ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="images/<?php echo $row['image']; ?>">
                <p class="item_name"><?php echo $row['product_name']; ?></p>
                <p class="item_details"><?php echo $row['product_description']; ?></p>
                <p class="item_price">PHP<?php echo $row['product_price']; ?></p>

                <!-- Add this form inside each item-preview div -->
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="item_name" value="<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="item_price" value="<?php echo $row['product_price']; ?>">
                    <input type="hidden" name="item_image" value="<?php echo $row['image']; ?>">
                    <button type="submit" class="add-to-cart-btn">Add to cart</button>
                </form>
            </div>
        <?php } ?>
    </div>
</section>
<!---------------------------------------------------------->





</body>
</html>



