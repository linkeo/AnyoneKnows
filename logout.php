<?php

require('model.php');
if(isset($_COOKIE['login'])){
	$savetime=time()-3600;
	setcookie('login','false',$savetime);
	setcookie('uid','NaN',$savetime);
}
$url='login.php';
if(isset($_GET['url']))
	$url=$_GET['url'];
header("Location: $url");

?>