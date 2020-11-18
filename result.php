<?php
	include "inc/header.php";
	include "inc/slider.php";
	
?>
<div class="section group border border-info">
<?php 
          
          $txtSearch = $_GET['txtSearch'];
          $search = $product->search($txtSearch);
          if($search){
              while($result = $search->fetch_assoc()){
           
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
            <?php
	include "inc/footer.php";
	
?>