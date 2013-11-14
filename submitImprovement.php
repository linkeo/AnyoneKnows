<?php
require('mysql.php');
$uid=$_POST['uid'];
$aid=$_POST['aid'];
$content=$_POST['content'];
if(insert_improvement($uid,$aid,$content)){
	echo 'success';
}else{
	echo 'fail';
}
?>