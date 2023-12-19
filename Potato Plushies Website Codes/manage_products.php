<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="signup.css">
    <title>Manage Products</title>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <div class="login">
                <div class="login-header">
                    <h3>ADD PRODUCT HERE</h3>
                    <h4>Please enter your details correctly.</h4>
                </div>
            </div>
            <form class="login-form" action="create_items.php" method="POST">

                <input type="hidden" name="product_id" 
                value="<?php echo $item['product_id'] ?>">

                <p>Product Name</p>
                <input type="text" name="product_name"/>
                <p>Product Price</p>
                <input type="text" name="product_price"/>
                <p>Product Description</p>
                <input type="text" name="product_description"/>
                <p>Image</p>
                <input type="text" name="image"/>
                <p>Product Status</p>
                <input type="text" name="product_status"/>
            
                <button type="submit" name="add_data">Add Product</button>
            </form>
        </div>
    </div>
</body>
<!-- add nalang ulit pag naayos 
      <footer>
        <p>&copy; 2023 Potato Plushies</p>
      </footer>
      -->
</html>