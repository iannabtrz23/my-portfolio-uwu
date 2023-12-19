<!DOCTYPE html>
<html lang="en">
<head>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
}

.order-form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
}

label {
    display: block;
    margin-bottom: 5px;
}

select,
input {
    width: 100%; /* Make the input fields and select boxes take full width */
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    width: 100%; /* Make the button take full width */
}

button:hover {
    opacity: 0.8;
}



</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customized Blanket Ordering</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


    <header>
        <h1>Customize My Own Blanket</h1>
    </header>

    <section class="order-form">
        <!-- Your order form goes here -->
        <form action="order.php" method="post">
            <!-- Include input fields for customization -->
            <label for="size">Blanket Size:</label>
            <select name="size" id="size">
                <option value="crib">Crib (36" x 54")</option>
                <option value="lapghan">Lapghan (40" x 48")</option>
                <option value="twin">Twin (39" x 75")</option>
                <option value="queen">Queen (60" x 80")</option>
                <option value="king">King (76" x 80")</option>
            </select>

            <label for="material">Material:</label>
            <select name="material" id="material">
                <option value="cotton">Cotton</option>
                <option value="wool">Wool</option>
                <option value="polyester">Polyester</option>
                <option value="microfiber">Microfiber</option>
                <option value="fleece">Fleece</option>
                <option value="cashmere">Cashmere</option>
                <option value="linen">Linen</option>
            </select>

            <label for="color">Color:</label>
            <select name="color" id="color">
                <option value="blue">Blue</option>
                <option value="black">Black</option>
                <option value="white">White</option>
                <option value="pink">Pink</option>
                <option value="orange">Orange</option>
                <option value="grey">Grey</option>
                <option value="beige">Beige</option>
                <option value="brown">Brown</option>
            </select>

            <label for="color">Color:</label>
            <input type="text" name="color" id="color" required>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required>

            <button type="submit">Place Order</button>
        </form>
    </section>

</body>
</html>


