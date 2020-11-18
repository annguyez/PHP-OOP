<?php
	include "inc/header.php";
	include "inc/slider.php";
	
?>
<?php
	if(!isset($_GET['productId']) || $_GET['productId']==NULL){
		echo "<script>window.location='404.php'</script>";
	}else{
		$id = $_GET['productId'];
	}
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
		$addToCart = $cart->addToCart($quantity,$id);
	}
	
?>
 <div class="main">
 <?php
		$getFullProductById = $pr->getFullProductById($id);
		if($getFullProductById){
			while($result = $getFullProductById->fetch_assoc()){
		
	?>
    <div class="content">
	
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']?> </h2>
					<p><?php echo $result['productDesc']?></p>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']?></span></p>
						<p>Category: <span><?php echo $result['catName']?></span></p>
						<p>Brand:<span><?php echo $result['branchName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="POST">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						
					</form>				
				</div>
				<?php
						if(isset($addToCart)){
							echo $addToCart;
						}
						?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['productDesc']?></p>
			</div>
		
				
	</div>
	<?php
			}
		}
		?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>

					<ul>
					<?php
						$getCategory = $cat->show_category();
						if($getCategory){
							while($category = $getCategory->fetch_assoc()){

						
					?>
				      <li><a href="productbycat.php?catId=<?php echo $category['catId']?>"><?php echo $category['catName']?></a></li>
				      <?php
					}
				}?>
				      
    				</ul>
					
    	
 				</div>
 		</div>
 	</div>
 <?php
	include "inc/footer.php";
?>