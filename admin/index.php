<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2> Dashbord</h2>
                <div class="block">               
                  Welcome
                  <?php
                    echo Session::get('adminName');
                  ?>
                  <?php
echo 'Current PHP version: ' . phpversion();
?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>