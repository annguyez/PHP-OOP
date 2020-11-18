
<?php
	include "inc/header.php";
	include "inc/slider.php";
	
?>

<?php
	if($_SERVER["REQUEST_METHOD"]== 'POST' && isset($_POST['login'])){
		$login = $customer->login($_POST);
	}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Login</h3>
			<?php
			if(isset($login)){
				echo $login;
			}
			?>
        	<p>Sign in with the form below.</p>
        	<form action="" method="POST">
                	<input name="email" type="text" placeholder="Name" class="field">
                    <input name="password" type="password" placeholder="Password" class="field">
                
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input name="login" type="submit" value="Sign In" class="grey"></input></div></div>
					
                    </div>
					</form>
					<div>
					<a href="register.php">Register</a>
					</div>
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include "inc/footer.php";
?>