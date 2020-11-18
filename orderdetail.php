<?php
	include "inc/header.php";
	include "inc/slider.php";
	
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Order Details</h2>
						<table class="tblone">
							<tr>
								<th>STT</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Status</th>
								<th width="10%">Action</th>
							</tr>
							<?php
                                $customerId = Session::get('customer_id');
								$getOrderDetail = $cart->getCartOrder($customerId);
								if($getOrderDetail){
									$i=0;
									$quantity=0;
									while($result = $getOrderDetail->fetch_assoc()){
										$i++;
							?>
							<tr>
								<td><?php echo $i?></td>
								<td height="100"><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" height="100" alt=""/></td>
								<td><?php echo $result['price']?></td>
								<td><?php echo $result['quantity']?></td>
								<td><?php 
								if($result['status']=='0'){
									echo 'Pending';
								}else{
									echo 'Processed';
								}
								?>
								</td>
								<?php
								if($result['status']=='0'){
								?>
								<td><?php echo 'N/A' ?></td>
								<?php
								}else{?>
								<td><a href="?orderId=<?php echo $result['cartId']?>">X</a></td>
								<?php
								}?>
								
							</tr>
							<?php
							}
						}?>
							
						</table>
			</div>
    	</div>  	
    </div>
 </div>
 <?php
	include "inc/footer.php";
?>