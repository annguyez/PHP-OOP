<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php
    require_once "../classes/category.php";
?>
<?php
    require_once "../classes/category.php";
?>
<?php
    require_once "../helpers/format.php";
?>
<?php
	$pr = new product();
	if(isset($_GET['productId'])){
		$id = $_GET['productId'];
		$deleteProduct = $pr->delete_product($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
		<?php
			if(isset($deleteProduct)){
				echo $deleteProduct;
			}
		?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Product Price</th>
					<th>Image</th>
					<th>Category</th>
					<th>Branch</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
				$pr = new product();
				$fm = new Format();

				$showProduct = $pr->show_product();
				if($showProduct){
					$i=0;
					while($result = $showProduct->fetch_assoc()){
						$i++;
				
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['price']?></td>
					<td class="center"><img src="uploads/<?php echo $result['image']?>" width="80px";></td>
					<td class="center"> <?php echo $result['catName']?></td>
					<td class="center"> <?php echo $result['branchName']?></td>
					<td class="center"> <?php echo $fm->textShorten($result['productDesc'],20)?></td>
					<td class="center"> <?php if($result['type']==0){
						echo 'Feature';
					}else{
						echo 'Non-Feature';
					}?></td>
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

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
