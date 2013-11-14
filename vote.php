<?php
require('mysql.php');
if(isset($_POST['action'])){
	$action = $_POST['action'];
	$target = $_POST['target'];
	$uid = $_POST['uid'];
	$id = $_POST['id'];
	if($action=='upvote'&&$target=='question'){
		echo upvote_question($uid,$id);
	}else if($action=='downvote'&&$target=='question'){
		echo downvote_question($uid,$id);
	}else if($action=='upvote'&&$target=='answer'){
		echo upvote_answer($uid,$id);
	}else if($action=='downvote'&&$target=='answer'){
		echo downvote_answer($uid,$id);
	}else if($action=='star'&&$target=='question'){
		echo star_question($uid,$id);
	}else{
		echo 'error';
	}
}else{
	echo 'no aciton';
}
?>