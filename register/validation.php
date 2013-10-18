<?php
	require('../mysql.php');
	$type=$_POST['type'];
	if($type=='username'){
		if(check_exist_user($_POST['username']))
			echo 'exist';
		//if it's valid
		else
			echo 'ok';
	
	}
	else if($type=='email'){
		if(check_exist_email($_POST['email']))
			echo 'exist';
		else
			echo 'ok';
	}
?>