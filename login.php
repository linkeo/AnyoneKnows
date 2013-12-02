<!DOCTYPE html>
<html>
<head>
	<?php
		require('model.php');
		function login(&$loginuser,$username,$password){
			$result = login_user($username, $password);
			if($result=='username'){
				return $result;
			}else if($result=='password'){
				return $result;
			}else{
				$savetime=time()+60*60*24;
				setcookie("uid",$result['uid'],$savetime);
				setcookie("login",true,$savetime);
				return true;
			}
		}

		$url='index.php';
		if(isset($_GET['url']))
			$url=$_GET['url'];
		if(isset($_POST['url']))
			$url=$_POST['url'];

		$login  = false;
		if(isset($_POST["username"])){
			$login = login($loginuser,$_POST['username'],$_POST['password']);
			if($login==true)
				header("Location: $url");
		}
		common_head();
	?>
	<title>登录 Login - AnyoneKnows</title>
	<style type="text/css">
		#loginform label{
			display: block;
			color: #797979;
			font-weight: 700;
			line-height: 1.4em;
		}
		#loginform input{
			width: 250px;
			padding: 6px;
			font-family: Arial,  Verdana, Helvetica, sans-serif;
			font-size: 11px;
			border: 1px solid #cecece;
		}
		#loginform input[type='text'], #loginform input[type='password']{
			color: #949494;
		}
		#loginform input[type='submit']{
			display: block;
			margin-top: 1em;
			width: 264px;
		}
		.box{
			margin-left: auto;
			margin-right: auto;
			width: 266px;
		}
	</style>
</head>
<body>
	<nav> <?php common_nav(); ?> </nav>
	<div class='site'>
		<div class='pagehead container'>
			<h1 class='sitename'>Anyone<b>Knows</b></h1>
			<h3 class='sitename'>有谁<b>知道</b></h3>
		</div>
		<div class='container'>
		<div class='box'>
			<h2>用户登录</h2>
			<?php if($login==true||is_logged($login)){ ?>
				<p>您已登录成功<br><br> <a href='index.php' class='button'>回到主页</a></p>
			<?php }else{ ?>
			<?php if($login=='username'){ ?>
				<p class='error'><b>登录失败</b>: 该用户名不存在.</p>
			<?php }else if($login=='password'){ ?>
				<p class='error'><b>登录失败</b>: 密码不正确.</p>
			<?php } ?>
				<form id='loginform' action='login.php' method='post'>
					<label for='username'>用户名 Username</label>
					<input type='text' placeholder='username' name='username' class='textinput'>
					<label for='password'>密码 Password</label>
					<input type='password' placeholder='password' name='password' class='textinput'>
					<input type='hidden' name='url' value=<?php echo "'".$url."'"; ?>>
					<input type='submit' value='登录 Login' class='button primary'></form>
			<?php } ?>
		</div>
		</div>
	</div>

	<?php common_footer(); ?>
</body>
</html>