<?php
require('mysql.php');
$uid=$_POST['uid'];
$qid=$_POST['qid'];
$content=$_POST['content'];
if(insert_answer($uid,$qid,$content)){
	echo 'success';
}else{
	echo 'fail';
}
?>