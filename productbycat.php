<?php
	include "inc/header.php";
	include "inc/slider.php";
	
?>
<?php
	if(!isset($_GET['catId']) && $_GET['catId']){
		echo "<script>window.location='404.php'</script>";
	}else{
		$catId = $_GET['catId'];
	}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Soft by Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  <?php
			 $getProductByCatId = $cat->getProductByCatId($catId);
			 if($getProductByCatId){
				 while($result = $getProductByCatId->fetch_assoc()){

				 
		  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="detail-3.php"><img src="admin/uploads/<?php echo $result['image']?>" alt="" /></a>
					 <h2><?php echo $result['productName']?> </h2>
					 <p><?php echo $result['productDesc']?></p>
					 <p><span class="price"><?php echo $result['price']."$"?></span></p>
				     <div class="button"><span><a href="detail.php?productId=<?php echo $result['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php 
				}
				}else{
					echo "Category Not avaiable";
				
			} ?>
			</div>

	
	
    </div>
 </div>
 <?php
	include "inc/footer.php";
?>