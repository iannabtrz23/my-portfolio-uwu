<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="signup.css">
    <title>Potato Plushies Sign Up</title>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <div class="login">
                <div class="login-header">
                    <h3>REGISTER HERE</h3>
                    <h4>Please enter your details correctly.</h4>
                </div>
            </div>
            <form class="login-form" action="registration.php" method="POST">
                <p>First Name</p>
                <input type="text" name="user_firstname" />
                <p>Last Name</p>
                <input type="text" name="user_lastname"/>
                <p>Username</p>
                <input type="text" name="username"/>
                <p>Contact Number</p>
                <input type="number" name="contact_number"/>
                <p>Complete Address</p>
                <input type="text" name="user_address"/>
                <p>Email Address</p>
                <input type="text" name="email_address"/>
                <p>Password</p>
                <input type="password" name="password"/>
                <p>Confirm Password</p>
                <input type="password" name="confirm_password"/>
                <button type="submit" name="submit">register</button>
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