<?php include 'inc/header.php';?>
<?php
    include "../classes/branch.php";
?>
<?php include 'inc/sidebar.php';?>
<?php
	$branch = new branch();
	if(isset($_GET['branchId'])){
        $id = $_GET['branchId'];
        $deleteBranch = $branch->delete_branch($id);
    }	
		
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Branch List</h2>
                <div class="block">     
                  <?php
                    if(isset($deleteBranch)){
                        echo $deleteBranch;
                    }
                  ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Branch Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                        <?php
                            $show_branch = $branch->show_branch();
                            if($show_branch){
                                $i=0;
                                while($result = $show_branch->fetch_assoc()){
                                $i++;
                                
                            
                        ?>
					
						<tr class="odd gradeX">
							<td><?php echo $i;
							?></td>
							<td><?php echo $result['branchName'];?></td>
							<td><a href="branchedit.php?branchId=<?php echo $result['branchId']?>">Edit</a> || 
							<a onclick="return confirm('Are u want to delete')"
							 href="?branchId=<?php echo $result['branchId']?>">Delete</a></td>
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

