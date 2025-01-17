<?php require_once('../private/initialize.php'); ?>

<?php
user_require_login();
$account = find_user_by_email($_SESSION["user_email"]);

// Get page style from database
$layout = get_style_by_view(1);

$email = $_GET['email'];

if (is_post_request()) {

    $account_array = array();
    $account_array["id"] = $account['user_id'];
    $account_array["email"] = $_POST['email'];
    $account_array["password"] = $_POST['password'];
    $account_array["username"] = $_POST['username'];


    if (empty($_POST['email'])) {
        $new_email = $email;
    }
    if (empty($_POST['password'])) {
        $account_password = $account['password'];
    }


    $result = update_user_by_id($account_array);
    if ($result === true) {
        $_SESSION['message'] = 'User account updated.';
        redirect_to('account.php');
    } else {
        $errors = $result;
    }
} else {
    $account = find_user_by_email($email);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="X">
    <link rel="stylesheet" href="../css/style.css">
    <title>Account</title>

    <!-- load style from database -->
    <style>
        body {
            background-color: <?php echo $layout["background_color"]; ?>;
            background-color: <?php echo $layout["background_color"]; ?>;
        }

        .topnav {
            background-color: <?php echo $layout["margin_color"]; ?>;
        }

        .topnav a {
            color: <?php echo $layout["margin_text_color"]; ?>;
        }

        .container_footer {
            background-color: <?php echo $layout["margin_color"]; ?>;
            color: <?php echo $layout["margin_text_color"]; ?>;
        }

        .container_footer .footer_text {
            color: <?php echo $layout["margin_text_color"]; ?>;
        }

        .copyright {
            color: <?php echo $layout["margin_text_color"]; ?>;
        }
    </style>
</head>

<body>

    <?php
    $count = 0;
    if (!empty($_SESSION["cart"])) {  // if cart is not empty count number of product inside
        foreach ($_SESSION["cart"] as $key => $value) {
            $count++;
        }
    }
    ?>

    <!-- Haader -->
    <header>
        <div class="topnav" id="myTopnav">
            <a href="../index.php"><img src="../images/logo.png" alt="logo" class="logo"></a>
            <a href="../index.php" class="htext htext2">Home</a>
            <a href="../products.php" class="htext">Shop</a>
            <a href="account.php" class="htext">Account</a>
            <a href="cart.php" class="htext"><?php if ($count != 0) {
                                                    echo "Cart•";
                                                } else {
                                                    echo "Cart";
                                                } ?></a>
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="header_menu()">&#9776;</a>
            <a href="../contact.php" class="htext">Contact</a>
            <a href="../shipping-policy.php" class="htext_bottom">Shipping Policy</a>
            <a href="../privacy-policy.php" class="htext_bottom">Privacy Policy</a>
            <a href="../return-policy.php" class="htext_bottom">Return Policy</a>
        </div>
    </header>

    <!-- Show account info -->
    <p><a href="logout.php"> Logout</a></p>

    <div id="content">
        <div>
            <h1>Hi <?php echo h($account['username']); ?>!</h1>
        </div>

    </div>

    <a class="action" href="<?php echo "account.php"; ?> ">&laquo; Back to List</a>

    <div class="admin edit">
        <h1>Edit Customer Account</h1>
        <p class="red_alert">If field is left empty data will NOT be changed!</p>

        <!-- <?php // echo display_errors($errors); 
                ?> -->

        <form action="<?php echo "update.php?email=" . h(u($account['email'])); ?> " method="post">

            <dl>
                <dt>Email:</dt>
                <dd><input type="text" name="email" value="<?php echo $account['email']; ?>" /><br /></dd>
            </dl>

            <dl>
                <dt>Username:</dt>
                <dd><input type="text" name="username" placeholder="new username" value="<?php echo $account['username'] ?>" /><br /></dd>
            </dl>

            <dl>
                <dt>Password:</dt>
                <dd>
                    <input type="password" name="password" value="<?php echo $account['password']; ?>" id="mypassword" />
                    <input type="checkbox" onclick="show_password()">Show Password
                    <script src="../js/script.js"></script>
                </dd>
            </dl>
            <!-- <p>
                Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
              </p> -->
            <br />

            <div id="operations">
                <input type="submit" value="Save" />
            </div>
        </form>

    </div>

    <footer>
        <div class="container_footer">
            <br>
            <a href="index.php"><img src="../images/logo.png" alt="logo" class="footer_logo"></a>
            <div class="center">
                <a href="contact.php" class="footer_text">Contact</a>
                <a href="shipping-policy.php" class="footer_text">Shipping Policy</a>
                <a href="privacy-policy.php" class="footer_text">Privacy Policy</a>
                <a href="return-policy.php" class="footer_text">Return Policy</a>
                <a href="terms-and-conditions.php" class="footer_text">Term and Conditions</a>
            </div>
            <p class="copyright">Copyright &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> WEB | All Rights Reserved
            </p>
        </div>
    </footer>

    <script src="../js/script.js"></script>

</body>

</html>