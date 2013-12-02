<!doctype html>
<?php 
?>
<html>
<head>
	<?php require('model.php'); common_head(); ?>
	<link rel="stylesheet" type="text/css" href="css/user.css" >
	<script type="text/javascript">
		$(document).ready(function() {
			var standard = 100;//标准分:达到标准分颜色为#3F3F3F
			$('.dynamic-color').each(function(index, el) {
				var color = Math.floor(127*standard/(standard+parseInt($(this).text())));
				$(this).css('color','rgb('+color+','+color+','+color+')');
			});
		});
	</script>
<title>Users</title>

</head>
<body>
	<nav>
		<?php common_nav(); ?>
	</nav>
	<div class='site'>
		<div class='pagehead container'>
			<h1 class='sitename'>Anyone<b>Knows</b></h1>
			<h3 class='sitename'>有谁<b>知道</b></h3>
		</div>
		<div class='container'>
			<h2 class='title'>所有用户</h2>
			<?php
				$users = query_users();
				foreach ($users as $user) {
			?>
			<div class='athird'>
				<div class='box card'  href=<?php echo "user.php?uid=".$user['uid']; ?>>
					<a class='card-left' href=<?php echo "user.php?uid=".$user['uid']; ?>>
						<img src=<?php echo "'".get_avator($user)."'"; ?> class='avator big'>
					</a>
					<div class='card-right'>
						<div>
							<p class='username' id='user' uid=<?php echo "'".$user['uid']."'" ?>>
								<a  href=<?php echo "user.php?uid=".$user['uid']; ?>><?php echo $user['name'] ?></a>
								<?php if($user['gender']==1){ ?>
								<span class='gender-male'>♂</span>
								<?php }else if($user['gender']==2){ ?>
								<span class='gender-female'>♀</span>
								<?php } ?>
							</p>
							<p class='bonus'>
								<span class='gray'>积分 Bonus:  </span>
								<span class='dynamic-color'><?php echo query_bonus($user['uid']); ?></span>
							</p>
						</div>
					</div>
					<div class='clearfix'></div>
				</div>
			</div>
			<?php } ?>
			<div class='clearfix'></div>
		</div>
	</div>
	<?php common_footer(); ?>
</body>