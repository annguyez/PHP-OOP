
<?php
	include "inc/header.php";
	include "inc/slider.php";
	
?>
 <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $register = $customer->insertCustomer($_POST);
    }

?> 
<div class="main">
<div class="content">
<div class="register_account">
    		<h3>Register New Account</h3>
            <?php
                if(isset($register)){
                    echo $register;
                }
            ?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							<div>
						<select name="gender">
							<option value="null">Select a gender</option>         
							<option value="1">Male</option>
							<option value="0">Female</option>
		         </select>
				 </div>	
                
							<div>
							   <input type="text" name="address" placeholder="Address" >
							</div>
                            </td>
                            <td>
							
							<div>
								<input type="text" name="phone" placeholder="Phone">
							</div>
                            
                           
							<div>
								<input type="text" name="email" placeholder="E-Mail">
                                
							</div>
                            <div>
							<input type="password" name="password" placeholder="Password">
						</div>
		    			 </td>
		    			
		    </tr> 
		    </tbody>
            </table> 
		   <div class="search"><div><input type="submit" name="submit" value="Create Account"/></div></div>
		    
            <div class="clear"></div>
            <div>
            <a href="login.php">Login</a></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include "inc/footer.php";
?>