<!doctype html>
<?php 
	require('model.php');
	$result = false;
	if(!is_logged()){
		header('Location: login.php');
		if(!isset($_COOKIE['uid']))
			header('Location: logout.php');
	}else{
		if(isset($_POST['send']))
		$result = insert_question($_COOKIE['uid'], $_POST['title'], $_POST['content'], $_POST['tags']);
		if($result!=false)
			header("Location: question.php?qid=".$result['qid']);
	}
?>

<html>
<head>
	<?php
		common_head();
		editor_display();
	 ?>
	<title>提交失败</title>
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
			<?php if(isset($_POST['send'])){ ?>
			<h2 class='title error'><span class='sitename'>有谁<b>知道</b></span>:<?php
				echo $_POST['title'];
			?>
			</h2>
			<div class='content'><?php
				if(isset($_POST['content']))
					echo $_POST['content'];
				else
					echo $_POST['title'];
			?></div>
			<form action='post.php' method='post'>
				<input type='hidden' name='title' value=
				<?php echo '"'.$_POST['title'].'"'; ?>
				>
				<input type='hidden' name='content' value=
				<?php
					echo "'";
					if(isset($_POST['content']))
						echo $_POST['content'];
					else
						echo $_POST['title'];
					echo "'";
				?>
				>
				<input id='newquestion' type='submit' class='button primary' name='send' value='再次提交'>
			<?php }else{ ?>
			<h2 class='title error'>无接收数据</h2>
			<?php } ?>
		</form>
		</div>
	</div>

	<?php common_footer(); ?>
</body>
</html>