<?php require_once('../../private/initialize.php'); ?>

<?php admin_require_login(); 

    $account_set = find_all_admins();

?>


<?php $page_title = 'Account Menu'; //used in header.php?> 
<?php include(SHARED_PATH . '/header.php'); ?>


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
            <div>
                <h1>Admin Management</h1>

                <div class="actions">
                    <a class="action" href="<?php echo url_for('admin_account/new.php'); ?>">Create New Admin User</a>
                </div>

                <table class="list">
                    <tr>
                        
                        <th style="text-align: center;vertical-align: middle;">username</th>
  	                    <th>password</th>
  	                    <th>&nbsp;</th>
  	                    <th>&nbsp;</th>
  	                </tr>

                    <?php while($account = mysqli_fetch_assoc($account_set)) {?>
                    <tr>
                        <!-- <td><?php echo h($admin['id']); ?></td> -->
                        <td><?php echo h($account['username']); ?></td>
  	                    <td><?php echo h($account['password']); ?></td>
  	                    <td><a class="action" href="<?php echo url_for('admin_account/edit.php?id=' . h(u($account['id']))); ?>">Edit</a></td>
                        <!-- After delecting a product run this mysql code "ALTER TABLE `admins` AUTO_INCREMENT = 1" to reset the id auto increment -->
                        <td><a class="action" href="<?php echo url_for('admin_account/delete.php?id=' . h(u($account['id']))); ?>">delete</a></td>
  	                </tr>
                    <?php } ?>
                </table>


            </div>


        </div>


<?php include(SHARED_PATH . '/footer.php'); ?>
