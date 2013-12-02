<?php
require('mysql.php');
if(isset($_POST['uid'])){
	$target = $_POST['target'];
	$uid = $_POST['uid'];
	$id = $_POST['id'];
	if($target=='question'){
		echo delete_question($uid,$id);
	}else if($target=='answer'){
		echo delete_answer($uid,$id);
	}else if($target=='improvement'){
		echo delete_improvement($uid,$id);
	}else{
		echo 'error';
	}
}else{
	echo 'no aciton';
}
?>