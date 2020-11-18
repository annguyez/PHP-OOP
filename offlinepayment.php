<?php
	include "inc/header.php";
	include "inc/slider.php";
	
?>
<?php
    if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
        $customerId = Session::get('customer_id');
		$insertOr = $cart->insertOrder($customerId);
		$deleteCart = $cart->deleteAll();
		header('Location:success.php');
    }
?>
<?php
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
		$cartId = $_POST['cartId'];
		$update_quantity = $cart -> updateQuantity($quantity,$cartId);

		if($quantity<=0){
			$delete = $cart->deleteCart($cartId);
		}
	}
	if(isset($_GET['cartId'])){
		$cartId = $_GET['cartId'];
		$delete = $cart->deleteCart($cartId);
	}
?>

<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;url=?id=live'>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption" style="width:50%; float:left">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php
						if(isset($update_quantity)){
							echo $update_quantity;
						}
					?>
					
					<?php
					
					?>
						<table class="tblone">
							<tr>
                                <th width="10%">STT</th>
								<th width="15%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="20%">Quantity</th>
								<th width="20%">Total Price</th>
								
							</tr>
							<?php
								$getProductCart = $cart->getProductCart();
								if($getProductCart){
									$total = 0;
									$subtotal=0;
                                    $quantity=0;
                                    $i=0;
									while($result = $getProductCart->fetch_assoc()){
                                        $i++;
										
									
								
							?>
							<tr>
                                <td><?php echo $i?></td>
								<td height="100"><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" height="100" alt=""/></td>
								<td><?php echo $result['price']?></td>
								<td><?php echo $result['quantity']?></td>
									
								<td><?php
								$total = $result['price']*$result['quantity'];
								echo $total;
								?></td>
							
							</tr>
							<?php
							$subtotal += $total;
							$quantity  = $quantity + $result['quantity'];
							}
							
						}
						?>
							
						</table>
						<?php
									$checkCart = $cart->checkCart();
									if($checkCart){

									
								?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php
								
								echo $subtotal;
								session::set("quantity",$quantity);
								session::set("sum",$subtotal);
								?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php
								$vat = $subtotal *0.1;
								$grandtotal = $vat + $subtotal;
								echo $grandtotal;
								?> </td>
							</tr>
					   </table>
					   <?php
									}else{
										echo "Cart empty";
									}
								 
					   ?>
					</div>
					
    	</div> 



        <div class="cartoption" style="width:50%; float:right">		
			<div class="cartpage">
			    	<h2>Profile</h2>

                    <table class="data display datatable" id="example">
			<thead>
				<tr>
					
					<th style="width:20%">Name</th>
					<th style="width:10%">Gender</th>
					<th style="width:20%">Address</th>
					<th style="width:30%">Phone</th>
					<th style="width:20%">Email</th>
					
				
				</tr>
			</thead>
			
			<tbody>
			<?php
				
                $id = Session::get('customer_id');
				$showProfile = $customer->show($id);
				if($showProfile){
					
					while($result = $showProfile->fetch_assoc()){
				
			?>
				<tr class="odd gradeX">
					
					<td><?php echo $result['name']?></td>
					<td class="center"> <?php if($result['gender']==0){
						echo 'Male';
					}else{
						echo 'Femle';
					}?></td>
					<td><?php echo $result['address']?></td>
					<td><?php echo $result['phone']?></td>
					<td><?php echo $result['email']?></td>
                   
					</tr>
				<?php
					}
				}
			?>
			</tbody>
			
		</table>
                    </div>
                    </div> 
<div class="shopping" style="float:center; width:100%">
						
						
							<a type="submit" href="?orderId=order" class="btn btn-primary">Order Now</a>
						
					</div>

       <div class="clear"></div>
    </div>
 </div>
 <?php
	include "inc/footer.php";
?>