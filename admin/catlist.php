<?php include 'inc/header.php';?>
<?php
    include "../classes/category.php";
?>
<?php include 'inc/sidebar.php';?>
<?php
	$cat = new category();
	if(isset($_GET['catId'])){
		
		$id = $_GET['catId'];
		$deleteCat = $cat->delete_category($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">     
				<?php
						if(isset($deleteCat)){
							echo $deleteCat;
						}
					?>   
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$show_cat = $cat->show_category();
						
						if($show_cat){
							$i =0;
							while($result = $show_cat->fetch_assoc()){
								$i++;

					?>
					<?php
						if($result == 0){
							echo $result;
						}else{
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; 
							?></td>
							<td><?php echo $result['catName'];?></td>
							<td><a href="catedit.php?catId=<?php echo $result['catId']?>">Edit</a> || 
							<a onclick="return confirm('Are u want to delete')"
							 href="?catId=<?php echo $result['catId']?>">Delete</a></td>
						</tr>
						<?php
							}
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

