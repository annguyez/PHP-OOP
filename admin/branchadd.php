<?php include 'inc/header.php';?>
<?php include "../classes/branch.php"; ?>
<?php include 'inc/sidebar.php';?>

<?php
    $branch = new branch();
	if($_SERVER['REQUEST_METHOD']=="POST"){
        $branchName = $_POST['branchName'];
        $insertBranch = $branch->insert_branch($branchName);

    }
?>
        <div class="grid_10">
            <div class="box round first grid">

            <?php
                if(isset($insertBranch)){
                    echo $insertBranch;
                }
            ?>
                <h2>Add New Branch</h2>
               <div class="block copyblock"> 
                 <form action="branchadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="branchName" placeholder="Enter Branch Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>