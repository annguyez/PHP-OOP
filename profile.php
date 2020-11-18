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
			    	<h2>Profile</h2>

                    <table class="data display datatable" id="example">
			<thead>
				<tr>
					
					<th>Name</th>
					<th>Gender</th>
					<th>Address</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Password</th>
					
					<th>Action</th>
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
                    <td><?php echo $result['password']?></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId']?>">Edit</a> 
					|| <a onclick="return confirm('Are u want to delete')" href="?productId=<?php echo $result['productId']?>">Delete</a></td>
				</tr>
				<?php
					}
				}
			?>
			</tbody>
			
		</table>
                    </div>
                    </div>
                    </div>
                    </div>
<?php
	include "inc/footer.php";
?>