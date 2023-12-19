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

// Logout logic
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// Handle adding items to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Fetch main product details
    $mainProduct = $conn->query("SELECT * FROM product_details WHERE product_id = $product_id")->fetch_assoc();

    // Retrieve item details from the form
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];
    $itemImage = $_POST['item_image'];

    // Add item to the cart
    $cartItem = [
        'id' => $product_id,
        'name' => $itemName,
        'price' => $itemPrice,
        'image' => $itemImage
    ];
    $_SESSION['cart'][] = $cartItem;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        /* Your styles here */
    </style>
</head>
<body>

<h2>Your Shopping Cart</h2>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
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

        .remove-btn {
            background-color: #ff6347;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background-color: #e74c3c;
        }

        button[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
        }

        button[type="submit"]:hover {
            background-color: #2980b9;
        }

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
    </style>
<?php
// Check if the cart is not empty
if (!empty($_SESSION['cart'])) {
    ?>
    <table>
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php
        $totalPrice = 0; // Initialize total price variable
        // Loop through each item in the cart
        foreach ($_SESSION['cart'] as $index => $item) {
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>PHP<?php echo $item['price']; ?></td>
                <td>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="remove_index" value="<?php echo $index; ?>">
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </td>
            </tr>
            <?php
            // Accumulate the total price
            $totalPrice += $item['price'];
        }
        ?>
    </table>
    <p>Total: PHP<?php echo $totalPrice; ?></p>
    <form method="post" action="checkout.php">
        <button type="submit">Checkout</button>
    </form>
    <?php
} else {
    echo '<p>Your cart is empty.</p>';
}
?>

<a href="homepage.php">Continue Shopping</a>

</body>
</html>