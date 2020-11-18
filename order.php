<?php
	include "inc/header.php";
?>

<?php
		   $check = Session::get('customer_login');
		 	if($check==false){
                header('Location:login.php');
             }
		   ?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Order</h2>
                    </div>
                    </div>
                    </div>
                    </div>
<?php
	include "inc/footer.php";
?>