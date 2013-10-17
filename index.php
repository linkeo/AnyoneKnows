<!DOCTYPE HTML>
<html>
<head>
	<?php require('model.php'); common_head(); ?>
<title>AnyoneKnows</title>
<link rel="stylesheet" type="text/css" href="stylesheet/gh-buttons.css" >
<link rel="stylesheet" type="text/css" href="stylesheet/homepage.css" >

</head>
<body>
	<nav>
		<div id="navibar" class='container clearfix'>
			<div id='loginnav'>
				<form class='inline-form button-group' id='login' action='login.php' >
					<input type='text' name='username' id='username' placeholder='username'>
					<input type='password' name='password' id='password' placeholder='password'>
					<input type='submit' id='loginsubmit' class='button pill' value='Login'>
				</form>
			</div>
			<div id='usernav'>
				<div id='userinfo'>
					<div id="avator"><img src="image/avator.jpg"></div>
					<div id="loggeduser" class="username">湮灭星空</div>
				</div>
			</div>
			<div id="searchnav">
				<form class='inline-form button-group' id="search" action="search.php">
					<input type="text" name="keyword" id="keyword" placeholder="keyword"/>
					<input type="submit" id="searchsubmit" class='button pill' value="Search">
				</form>
			</div>
		</div>
	</nav>
	<div class='site clearfix'>
		<div class='pagehead container'>
			<h1>Anyone<b>Knows</b></h1>
			<div id='pagehead-button-group'class='button-group'>
				<a class='button' href='#'>Questions</a>
				<a class='button' href='#'>Tags</a>
				<a class='button' href='#'>Users</a>
				<a class='button primary' href='#'>Ask a question</a>
			</div>
		</div>
		<div class='container'></div>
	</div>
</body>