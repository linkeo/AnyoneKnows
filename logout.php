<?php

require('model.php');
if(isset($_COOKIE['login'])){
	$savetime=time()-3600;
	setcookie('login','false',$savetime);
	setcookie('uid','NaN',$savetime);
}
	$url=$_POST['url'];
header("Location: $url");

?>