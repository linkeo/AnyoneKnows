<?php
			// $connect=mysql_connect('localhost','root','141592653');
			// mysql_select_db('anyoneknows');
			// $query=mysql_query("select * from users where username='$username' and password='$password'");
			// if($row=mysql_fetch_object($query)){
			// 	$loginuser=$row->username;
			// 	setcookie("loginuser",$loginuser,time()+60*5);
			// }else{
			// 	$loginuser=null;
			// }
	$db_host='localhost';
	$db_user='root';
	$db_password='141592653';
	$db_schema='anyoneknows';
	$connect;

	function connect(){
		if(!$connect){
			$connect=mysql_connect($db_host,$db_user,$db_password);
			mysql_select_db($db_schema);
		}
	}

	function register_user($username, $password, $name, $email, $gender){
		$exists = check_exist_user($username);
		if($exists)
			return 'username';
		$exists = check_exist_email($email);
		if($exists)
			return 'email';
		connect();
	}
?>