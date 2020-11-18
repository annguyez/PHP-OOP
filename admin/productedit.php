<?php include 'inc/header.php';?>
<?php include "../classes/product.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/branch.php"; ?>
<?php include 'inc/sidebar.php';?>
<?php
    $pr = new product();

    if(!isset($_GET['productId']) || $_GET['productId']===NULL){
        echo "<script>window.location='productlist.php'</script>";
    }else{
        $id = $_GET['productId'];
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $update_product = $pr->update_product($_POST,$_FILES,$id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">       
        <?php
            if(isset($update_product)){
                echo $update_product;
            }
            $getProductById = $pr->getProductById($id);
                    if($getProductById){
                       while($getProductResult = $getProductById->fetch_assoc()){
                         
        ?>        
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php
                                   echo $getProductResult['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select Category</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                                
                            ?>
                            <option
                            <?php
                                if($result['catId']==$getProductResult['catId']){
                                    echo 'selected';
                                }
                            ?>
                            
                             value="<?php echo $result['catId']?>"> <?php echo $result['catName']?></option>
                            <?php
                    }
                }
                ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Branch</label>
                    </td>
                    <td>
                        <select id="select" name="branch">
                            <option disable>Select Brand</option>
                            <?php
                                $branch = new branch();
                                $branchlist = $branch->show_branch();
                                if($branchlist){
                                    while($result = $branchlist->fetch_assoc()){
                                
                            ?>
                            <option
                            <?php
                            if($result['branchId']==$getProductResult['branchId']){
                                echo 'selected';
                            }
                            ?>
                            
                             value="<?php echo $result['branchId']?>"><?php echo $result['branchName']?></option>
                            <?php
                    }
                }
                ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="productDesc"><?php
                                   echo $getProductResult['productDesc']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php
                                   echo $getProductResult['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php
                                   echo $getProductResult['image']; ?>" width="80px"/><br/>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                               if($getProductResult['type']==0){
                                ?>
                               <option selected value="0">Non-Featured</option>
                               <option value="1">Featured</option>
                               
                               
                               <?php
                               } else{
                                ?>
                                <option selected value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                                <?php
                               } 
                            ?>
                            
                            
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php';?>