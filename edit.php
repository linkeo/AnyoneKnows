<!doctype html>
<?php
	require("model.php");
	if(isset($_POST['send'])){
		$uid = $_POST['uid'];
		$avator = $_POST['avator'];
		$name = $_POST['name'];
		$website = $_POST['website'];
		$location = $_POST['location'];
		update_user($uid,$avator,$name,$website,$location);
		header("Location: user.php?uid=".$uid);
	}else{
		if(!isset($_GET['uid']))
			header("Location: users.php");
		else{
			$user = query_user_by_uid($_GET['uid']);
			$loginuid = 0;
			if(is_logged()){
				$loginuid = $_COOKIE['uid'];
				if($loginuid!=$user['uid'])
					header("Location: user.php?uid=".$user['uid']);
			}else
				header("Location: user.php?uid=".$user['uid']);
		}
	}
?>
<html>
<head>
	<?php common_head(); ?>
<title>编辑个人资料 - <?php echo $user['username'] ?></title>
<link rel="stylesheet" type="text/css" href="css/user.css" >

</head>
<body>
	<nav>
		<?php common_nav(); ?>
		<script language='javascript' src='./edit.js'></script>
	</nav>
	<div class='site'>
		<div class='pagehead container'>
			<h1 class='sitename'>Anyone<b>Knows</b></h1>
			<h3 class='sitename'>有谁<b>知道</b></h3>
		</div>
		<div class='container'>
			<div class='box'>
				<div class='title'>
					<h2>编辑个人资料 - <?php echo $user['username'] ?></h2>
					<form id='edit-form' action='edit.php' method='post'>
						<input type='hidden' name='uid' value=<?php echo "'".$user['uid']."'" ?>>
						<div class='property'>
							<label class='attr'>头像 Avatar</label>
							<input type='hidden' name='avator' id='avator-input' value=<?php echo $user['avator'] ?>>
							<img src=<?php echo "'".get_avator($user)."'"; ?> class='avator big edit' id='avator-show'>
							<div class='fixed box hidden' id='avator-panel'>
								<div>
									<?php
									for($index=0;$index<65;$index++){
									?>
									<img src=<?php echo "'".get_avator_by_index($index,$user['gender'])."'"; ?> class='avator big edit selection' value=<?php echo "$index"; ?>>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class='property'>
							<label class='attr' for='name'>昵称 Nickname</label>
							<input type='text' name='name' id='name' value=<?php echo "'".$user['name']."'" ?>>
						</div>
						<div class='property'>
							<label class='attr' for='website'>个人网站 Website</label>
							<input type='text' name='website' id='website' value=<?php echo "'".$user['website']."'" ?>>
						</div>
						<div class='property'>
							<label class='attr' for='location'>所在城市 Location</label>
							<input type='text' name='location' id='location' value=<?php echo "'".$user['location']."'" ?>>
						</div>
						<br>
						<div class='property'>
							<input type='submit' name='send' class='button primary big' value='提交'>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php common_footer(); ?>
</body>