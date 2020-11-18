<?php include 'inc/header.php';?>
<?php include "../classes/branch.php"; ?>
<?php include 'inc/sidebar.php';?>
<?php
    $branch = new branch();
    if(!isset($_GET['branchId']) || $_GET['branchId']===NULL){
         echo "<script>window.location='branchlist.php'</script>";
    }else{
        $id = $_GET['branchId'];
    }
?>
<?php
    
	if($_SERVER['REQUEST_METHOD']=="POST"){
        $branchName = $_POST['branchName'];
        $updateBranch = $branch->update_branch($branchName,$id);
        echo "<script>window.location='branchlist.php'</script>";
    }
?>
        <div class="grid_10">
            <div class="box round first grid">

            <?php
                if(isset($updateBranch)){
                    echo $updateBranch;
                }
            ?>
                <h2>Edit Branch</h2>
               <div class="block copyblock"> 
               <?php
               
                $get_name_branch = $branch->getBranchById($id);
                if($get_name_branch){
                while($result = $get_name_branch->fetch_assoc()){

                
               ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php
                                 echo $result['branchName'];
                                ?>" name="branchName" placeholder="Enter Branch Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                }
                }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>