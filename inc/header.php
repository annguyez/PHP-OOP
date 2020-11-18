<?php
    include_once 'lib/session.php';
    Session::init();
?>
<?php
	include_once 'lib/database.php';
	include_once 'helpers/format.php';

	spl_autoload_register(function($className) {
		include_once "classes/".$className.".php";
	});
	$db = new Database();
	$fm = new Format();
	$cart = new cart();
	$user = new user();
	$cat = new category();
	$branch = new branch();
	$pr = new product();
	$customer = new customer();

?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE php>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>

<?php
	$product = new product();
	if(isset($_GET['$txtSearch']) && isset($_GET['submit'])){
		$txtSearch = $_GET['$txtSearch'];
		$search = $product->search($txtSearch);
	}
?>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo1.png" style="width:50%; padding-top:30px;" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="result.php" method="GET">
				    	<input type="text" name="txtSearch" placeholder="Search for Products">
						<input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="badge badge-danger">
								<?php
									$checkCart = $cart->checkCart();
									if($checkCart){
										$sum = Session::get("sum");
										$quantity = Session::get("quantity");
										echo $quantity;
									}else{
										echo "empty";
									}
								?>
								
								</span>
							</a>
						</div>
			      </div>
				  <?php
				 if(isset($_GET['customerId'])){
					//Xóa tất cả giỏ hàng
					//$delCart = $cart->deleteAll(); 
					Session::destroy();
				 } 
				  ?>
		   <div class="login">
		   <?php
		   $check = Session::get('customer_login');
		 	if($check == false){
				echo '<a href="login.php">Login</a></div>';
			}else{
				echo '<a href="?customerId='.Session::get('customer_id').'">Logout</a></div>';
			}
		   ?>
		   
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <li><a href="cart.php">Cart</a></li>

	  <?php
		  $login_check = Session::get('customer_login');
		  if($login_check==false){
			  echo '';
		  }else{
			  echo '<li><a href="profile.php">Profile</a> </li>';
		  }
	  ?>
	   <li><a href="orderdetail.php">Order Details</a></li>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>