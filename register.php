<!DOCTYPE HTML>
<html>
<head>
	<?php
		$register=isset($_POST["username"]);
		if($register){

		}

	?>
	<style type="text/css">
	label{ width: 100px; display: inline-block;}
	input{
		display: inline;
		width: 260px;
	}
	input#sex{
		width: auto;
	}
	.sex{
		display: inline;
		width: 80px;
		margin-right: 10px;
	}
	.sex.last{
		margin-right: 0px;
	}
	</style>
	<?php require('model.php'); common_head(); ?>
	<title>Register an AnyoneKnows account</title>
</head>
<body>
	<form action='register.php' onSubmit='return checkForm(this);' method='post'>
		<label for="username">Username:</label>
		<input type='text' name='username' id="username" placeholder="6-25 digits or letters">
		<br>
		<label for="password">Password:</label>
		<input type='password' name='password' id='password' placeholder="6-25 digits or letters">
		<br>
		<label for='name'>Real Name:</label>
		<input type='text' name='name' id='name' placeholder='within 32 characters'>
		<br>
		<label for='email'>E-mail:</label>
		<input type='email' name='email' id='email' placeholder='your e-mail to validate'>
		<br>
		<label>Gender:</label>
		<div class="sex"><input type="radio" id='sex' name="sex" value="secret" checked="checked"> Secret</div>
		<div class="sex"><input type="radio" id='sex' name="sex" value="male" > Male</div>
		<div class="sex last"><input type="radio" id='sex' name="sex" value="female" > Female</div>

	</form>
</body>
</html>