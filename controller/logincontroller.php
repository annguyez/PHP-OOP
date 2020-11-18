<?php
	include '../classes/adminlogin.php';
	
?>
<?php
	$class = new adminlogin();
	if($_SERVER['REQUEST_METHOD']==="POST"){
		$adminUser = $_POST['adminUser'];
		$adminPass = md5($_POST['adminPass']);

		$login_check = $class -> login_admin($adminUser, $adminPass);
	}
?>