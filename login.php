<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<link rel="stylesheet" type="text/css" href="homepage.css">
	<script language="javascript" src="jquery-2.0.3.js"></script>
	<?php
		function login(&$loginuser,$username,$password){
			$connect=mysql_connect('localhost','root','141592653');
			mysql_select_db('anyoneknows');
			$query=mysql_query("select * from users where username='$username' and password='$password'");
			if($row=mysql_fetch_object($query)){
				$loginuser=$row->username;
				setcookie("loginuser",$loginuser,time()+60*5);
			}else{
				$loginuser=null;
			}
		}

		if(isset($_POST["username"])){
			login($loginuser,$_POST['username'],$_POST['password']);
		}
		else if(isset($_COOKIE["loginuser"])){
			$loginuser=$_COOKIE["loginuser"];
		}
		else{
			$loginuser=null;
		}
	?>
	<script type="text/javascript">
		$(document).ready(function(){
		});
	</script>
</head>
<body>
	<header>
		<?php if($loginuser){
			echo "<div id='user' href='logout()'>$loginuser</div>";
		}else{
			echo "<form id='loginform' action='index.php' method='post'><input type='text' placeholder='username' name='username'>";
			echo "<input type='password' placeholder='password' name='password'><input type='submit' value='login'></form>";
		} ?>
	</header>
	<div class='headerplace'></div>
	<div class='logo'>
		<img src='logo.svg'>
	</div>
	<div class='searchbar'>
		<form action="search.php">
			<input type='text' id='keyword' name='keyword' placeholder='Search your problem'>
			<input type='submit' value='Search' id='searchsubmit'>
		</form>
	</div>

	<footer>©2013 Linkeo</footer>
</body>
</html>