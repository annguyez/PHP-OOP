<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/cart.php');
    
?>
<?php
$cart = new cart();
if(isset($_GET['shiftId'])){
	$id = $_GET['shiftId'];
	$shifted = $cart->change($id);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php
					if(isset($shifted)){
						echo $shifted;
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
								<th>STT</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="25%">Customer</th>
								<th width="20%">Status</th>
								<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
				$cart = new cart();
				$getInbox = $cart->getInboxCart();
				if($getInbox){
					$i=0;
					while($result = $getInbox->fetch_assoc()){
						$i++;
				?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $result['productName']?></td>
							<td><img src="uploads/<?php echo $result['image']?>" height="100" alt=""/></td>
							<td><?php echo $result['price']?></td>
							<td><?php echo $result['quantity']?></td>
							<td><a href="customer.php?customerId=<?php echo $result['customerId']?>">View</a></td>
							<td><?php 
								if($result['status']=='0'){
									?>
									<a href="?shiftId=<?php echo $result['id']?>">Pending</a>
								<?php
								}else{
								
								?><a href="?shiftId=<?php echo $result['id']?>">Remove</a>	
								<?php
								}
							?>
							</td>
								
							<td><a href="">Edit</a> || <a href="">Delete</a></td>
						</tr>
						<?php
						}
					}?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
