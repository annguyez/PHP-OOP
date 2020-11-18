<?php
	include "inc/header.php";
	include "inc/slider.php";
	
?>

 <div class="main">

	<?php
	echo session_id();
	?>
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group border border-info">
		  <?php
				$getProductFeathered = $pr -> getProduct_Feathered();
				if($getProductFeathered){
					while($result = $getProductFeathered->fetch_assoc()){
				 
		  ?>
				<div class="grid_1_of_4 images_1_of_4 ">
					 <a href="detail.php?productId=<?php echo $result['productId']?>"><img src="admin/uploads/<?php echo $result['image']?>" alt="" /></a>
					 <h2><?php echo $result['productName']?> </h2>
					 <p><?php echo $fm->textShorten($result['productDesc'],50)?> </p>
					 <p><span class="price"><?php echo $result['price']." "."$"?> </span></p>
				     <a  href="detail.php?productId=<?php echo $result['productId']?>" class="details btn btn-info  btn-lg" type="buttom">Details</a>
				</div>
				<?php
				}
			}
			?>
				
			</div>
			<div class="">
				<?php
					$all_product = $pr->getAll();
					$count = mysqli_num_rows($all_product); //đếm số dòng
					
					$count_buttom = ceil($count/4); // làm tron số trang
					$i=0;
					for($i=1;$i<=$count_buttom;$i++){
						echo '<a style="padding: 0 15px; font-size:16px !important;"
						 href="index.php?page='.$i.'">'.$i.'</a>';
					}
				?>
				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
				$getProductNew = $pr -> getProductNew();
				if($getProductNew){
					while($result = $getProductNew->fetch_assoc()){
				 
		 		 ?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="detail.php"><img src="admin/uploads/<?php echo $result['image']?>" alt="" /></a>
					 <h2><?php echo $result['productName']?> </h2>
					 <p><?php echo $fm->textShorten($result['productDesc'],50)?> </p>
					 <p><span class="price"><?php echo $result['price']." "."$"?> </span></p>
				     <a  href="detail.php?productId=<?php echo $result['productId']?>" class="details btn btn-info  btn-lg" type="buttom">Details</a>
				</div>
				<?php
					}
				}
				?>
			</div>
    </div>
 </div>
 <?php
	include "inc/footer.php";
?>