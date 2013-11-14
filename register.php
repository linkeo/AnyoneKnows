<!DOCTYPE html>
<head>
	<meta charset='utf-8'>
	<title>注册账号 - AnyoneKnows</title>
	<?php require('model.php');
		common_head();
	?>
	<link rel="stylesheet" href="/css/register.css" type="text/css" media="screen" />
	<?php
		$result=null;
		if(isset($_POST['send'])){
			$result=register_user($_POST['username'],$_POST['pass1'],$_POST['name'],$_POST['email'],$_POST['gender']);
			if($result=='success')
				header("Location: /login.php");
		}
	?>
</head>
<body>
	<nav>
		<?php common_nav(); ?>
	</nav>
	<br>
	<div id="container" class ='box pagehead'>
		<?php if($result==null||!isset($_POST['send'])){ ?>
			<h1 class='sitename'>Anyone<b>Knows</b></h1>
			<h2>注册新的账号</h2>
		<?php }else{ ?>
			<h2 class='error'>注册失败! 请重新注册</h2>
			<p class='error'>失败原因: <?php
				switch($result){
					case 'username': echo '您慢了一步, 用户名已被抢注!';break;
					case 'email': echo '您的E-mail已被注册!';break;
					case 'fail': echo '创建用户失败, 请您再试一次!';break;
				}
			?></p>
		<?php }?>

		<form method="post" id="customForm" action="#">
			<div>
				<label for="username">用户名 Username</label>
				<input id="username" name="username" type="text" class='textinput' />
				<span id="usernameInfo">6-25个小写英文字母或数字</span>
			</div>
			<div>
				<label for="pass1">密码 Password</label>
				<input id="pass1" name="pass1" type="password" class='textinput' />
				<span id="pass1Info">6-25个英文字母或数字或下划线(_)</span>
			</div>
			<div>
				<label for="pass2">确认密码 Confirm Password</label>
				<input id="pass2" name="pass2" type="password" class='textinput' />
				<span id="pass2Info">再输入一次密码</span>
			</div>
			<div>
				<label for="name">昵称 Nickname</label>
				<input id="name" name="name" type="text" class='textinput' />
				<span id="nameInfo">最多32个字符</span>
			</div>
			<div>
				<label for="email">电子邮件 E-mail</label>
				<input id="email" name="email" type="text" class='textinput' />
				<span id="emailInfo">请输入可用的E-mail, 这要用作激活您的账号.</span>
			</div>
			<div>
				<label>性别 Gender</label>
				<input id="gender0" name="gender" type="radio" value='0' checked='checked'><span class='sexlabel'>保密</span></input>
				<input id="gender1" name="gender" type="radio" value='1'><span class='sexlabel'>男</span></input>
				<input id="gender2" name="gender" type="radio" value='2'><span class='sexlabel'>女</span></input>
			</div>
			<div>
				<input id="send" class='button primary' name="send" type="submit" value="注册 Register" />
			</div>
		</form>
	</div>
	<script type="text/javascript" src="regvalidation.js"></script>
	<?php common_footer(); ?>
</body>
</html>