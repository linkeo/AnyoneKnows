<?php
require('mysql.php');
if(isset($_POST['uid'])){
	$uid = $_POST['uid'];
	$qid = $_POST['qid'];
	$aid = $_POST['aid'];
	echo accept_answer($uid, $qid, $aid);
}else{
	echo 'no aciton';
}
?>