<!doctype html>
<?php
	require("model.php");
	if(!isset($_GET['uid']))
		header("Location: users.php");
	else
		$user = query_user_by_uid($_GET['uid']);
	$loginuid = 0;
	if(is_logged())
		$loginuid = $_COOKIE['uid'];
?>
<html>
<head>
	<?php common_head(); ?>
<title><?php echo $user['name'] ?></title>
<link rel="stylesheet" type="text/css" href="css/user.css" >

</head>
<body>
	<nav>
		<?php common_nav(); ?>
		<script language='javascript' src='./user.js'></script>
	</nav>
	<div class='site'>
		<div class='pagehead container'>
			<h1 class='sitename'>Anyone<b>Knows</b></h1>
			<h3 class='sitename'>有谁<b>知道</b></h3>
		</div>
		<div class='container'>
			
			<div class='box'>
				<div class='title'>
				<img src=<?php echo "'".get_avator($user)."'"; ?> class='avator big'>
				<span class='username' id='user' uid=<?php echo "'".$user['uid']."'" ?>><?php echo $user['name'] ?>
					<?php if($user['gender']==1){ ?>
					<span class='gender-male'>♂</span>
					<?php }else if($user['gender']==2){ ?>
					<span class='gender-female'>♀</span>
					<?php } ?>
				</span>
				<?php if($loginuid==$user['uid']){ ?>
				<a href=<?php echo "edit.php?uid=".$user['uid']; ?> class='button big primary' id='edit'>编辑个人资料</a>
				<?php } ?>
				</div>
				<div class='left'>
					<!-- email   	varchar 128
					website 	varchar 128
					location	varchar 128
					gender  	int 1
					avator  	longblob
					time    	datetime -->
					<div class='property'>
						<span class='attr'>电子邮箱 E-mail: </span>
						<span class='attr-value'><?php echo $user['email']; ?></span>
					</div>
					<div class='property'>
						<span class='attr'>个人网站 Website: </span>
						<span class='attr-value'><?php echo $user['website']; ?></span>
					</div>
					<div class='property'>
						<span class='attr'>所在城市 Location: </span>
						<span class='attr-value'><?php echo $user['location']; ?></span>
					</div>
					<div class='property'>
						<span class='attr'>注册时间 Reg-Time: </span>
						<span class='attr-value'><?php echo date('Y年m月d日 H:i:s',strtotime($user['time'])); ?></span>
					</div>
				</div>
				<div class='right'>
					<div class='property'>
						<span class='attr'>积分 Bonus: </span>
						<span class='attr-value'><?php echo query_bonus($user['uid']); ?></span>
					</div>
					<div class='property'>
						<span class='attr'>问题 Questions: </span>
						<span class='attr-value'><?php echo count_question_by_uid($user['uid']); ?></span>
					</div>
					<div class='property'>
						<span class='attr'>回答 Answers: </span>
						<span class='attr-value'><?php echo count_answer_by_uid($user['uid']); ?></span>
					</div>
					<div class='property'>
						<span class='attr'>被采纳 Accepted: </span>
						<span class='attr-value'><?php echo ($user['uid']); ?></span>
					</div>
				</div>
				<div class='clearfix'></div>
			</div>
			<br>
			<div class='box'>
				<div class='title'>
					<div class='button-group' id='list-option'>
						<?php
						if($loginuid==$user['uid']){
							$callstr = '我'; 
						}else{
							if($user['gender']==2){
								$callstr = '她';
							}else{
								$callstr = '他';
							} 
						} 
						?>
						<span class='button big' id='questions'><?php echo $callstr; ?>的问题</span>
						<span class='button big' id='answers'><?php echo $callstr; ?>的回答</span>
						<span class='button big' id='bonus'><?php echo $callstr; ?>的积分</span>
						<?php
						if($loginuid==$user['uid']){
						?>
						<span class='button big' id='star'><?php echo $callstr; ?>的收藏</span>
						<?php
						} 
						?>
					</div>
				</div>
				<div id='list'>
				
				</div>
			</div>
		</div>
	</div>
	<?php common_footer(); ?>
</body>