<?php require_once('../../private/initialize.php');
admin_require_login();


$page_title = 'Edit';
include(SHARED_PATH . '/header.php');

$product_id = $_GET['id'];

$product = find_product_by_id($product_id);

// Check is form posted
if (is_post_request()) {

    // if cancel button was clicked
    if (isset($_POST["cancel"])) {
        header("Location: index.php");
    }
    $product_name = $_POST['product_name'];
    $product_img = $_POST['product_img'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_quantity = $_POST['product_quantity'];

    // update product
    $result = update_product($product_id, $product_name, $product_img, $product_price, $product_description);
    if ($result) {
        redirect_to(url_for('product/index.php'));
    }
}

?>

<body>
    <header>
        <h1>Admin: <?php echo $_SESSION['username'] ?? ''; ?></h1>
        <nav>
            <ul>

                <li><a href="<?php echo url_for('index.php'); ?>"> Main Menu</a> </li>
                <li><a href="<?php echo url_for('admin_account/index.php'); ?>"> Admin Accounts</a> </li>
                <li><a href="<?php echo url_for('user_account/index.php'); ?>"> Customer Accounts</a> </li>
                <li><a href="<?php echo url_for('product/index.php'); ?>"> Products</a> </li>
                <li><a href="<?php echo url_for('web_edit/index.php'); ?>"> Page Editor</a> </li>
                <li><a href="<?php echo url_for('admin_account/logout.php'); ?>"> Logout</a> </li>
            </ul>
        </nav>
    </header>


    <div id="content">
        <p class="red_alert">If field is left empty data will NOT be changed!</p>

        <div id="content">

            <a class="action" href="<?php echo url_for('product/index.php'); ?>">&laquo; Back to List</a>

            <div class="subject new">

                <h1>Edit Product</h1>

                <!-- Display product info -->
                <table class="list" style="margin-bottom: 0;">
                    <tr>
                        <th>product_name</th>
                        <th>Product Image</th>
                        <th>Product Description</th>
                        <th>Product Price</th>
                        <th>Inventory</th>
                    </tr>

                    <!-- Look for product using id -->
                    <?php
                    $product = find_product_by_id($product_id);
                    ?>
                    <tr>
                        <td><?php echo h($product['product_name']); ?></td>
                        <td><img width="200px" src="images/<?php echo h($product['product_img']); ?>" alt="Image of Product"></td>
                        <td><?php echo h($product['product_description']); ?></td>
                        <td>$<?php echo h($product['product_price']); ?></td>
                        <td><?php echo h($product['product_quantity']); ?></td>
                    </tr>
                </table>

                <!-- Fields to update product -->
                <form action="<?php echo url_for('product/edit.php?id=' . h(u($product_id))); ?>" method="post" enctype="multipart/form-data">
                    <dl>
                        <dt>Product Name:</dt>
                        <dd><input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" /></dd>
                        <br><br><br>
                        <dt>Image name:</dt>
                        <dd><input type="text" name="product_img" value="<?php echo $product['product_img']; ?>"/></dd>
                        <br><br><br>
                        <dt>Upload Image:</dt>
                        <dd><input type="file" id="fileToUpload" name="fileToUpload" accept="image/*"></dd>
                        <br><br>
                        <dt>Product Price:</dt>
                        <dd><input type="text" name="product_price" value="<?php echo $product['product_price']; ?>"> </input></dd>
                        <br><br><br>
                        <dt>Inventory:</dt>
                        <dd><input type="text" name="product_quantity" value="<?php echo $product['product_quantity']; ?>"> </input></dd>
                        <br><br><br>
                        <dt>Product Description:</dt>
                        <dd><textarea class="text_area" name="product_description"><?php echo $product['product_description']; ?></textarea></dd>
                        <br><br><br><br><br>
                    </dl>

                    <div>
                        <input type="submit" value="Save" />
                        <input style="margin-left:50px;" type="submit" name="cancel" value="Cancel" />
                    </div>
                </form>


            </div>


        </div>


    </div>

    <?php include(SHARED_PATH . '/footer.php'); ?>