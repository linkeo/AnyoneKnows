<!DOCTYPE HTML>
<html>
<head>
	<?php
		$register=isset($_POST["username"]);
		if($register){

		}

		require('model.php');
		common_head();
	?>
	<script type="text/javascript">
		function checkForm(form){
			checkUsername();
		}
		function checkUsername(){
			var username = $('#username').val();
			if(username.length<6){
				$('#usernamehint').text('too short!');
				return false;
			}else if(username.length>25){
				$('#usernamehint').text('too long!');
				return false;
			}else if(username.matches(/sd/i))
		}
	</script>
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
	.submit{
		width: 80px;
	}
	</style>
	<title>Register an AnyoneKnows account</title>
</head>
<body>
	<form action='register.php' onSubmit='return checkForm(this);' method='post'>
		<label for="username">Username:</label>
		<input type='text' name='username' id="username" placeholder="6-25 digits or letters"><span id='usernamehint' />
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
		<br>
		<input type='submit' class='submit' value='register'>
	</form>
</body>
</html>