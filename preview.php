<!doctype html>
<html>
<head>
	<?php require('model.php');
		common_head();
		editor_display();
	 ?>
	<title>预览</title>
    </script>
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
			<h2 class='title'><span class='sitename'>有谁<b>知道</b></span>:<?php
				echo $_POST['newtitle'];
			?>
			</h2>
			<div class='content'><?php
				if(isset($_POST['newcontent']))
					echo $_POST['newcontent'];
				else
					echo $_POST['newtitle'];
			?></div>
			<?php
				preg_match_all('/\w+/', $_POST['newtags'], $match);
				foreach ($match[0] as $value) {
					?>
					<span class='tag big'><?php echo $value; ?></span>
					<?php
				}
			?>
			<form action='post.php' method='post'>
				<input type='hidden' name='title' value=
				<?php echo '"'.$_POST['newtitle'].'"'; ?>
				>
				<input type='hidden' name='tags' value=
				<?php
					echo json_encode($match[0]);
				?>
				>
				<input type='hidden' name='content' value=
				<?php
					echo "'";
					if(isset($_POST['newcontent']))
						echo $_POST['newcontent'];
					else
						echo $_POST['newtitle'];
					echo "'";
				?>
				>
				<input id='newquestion' type='submit' class='button primary' name='send' value='确认提交'>
			<?php }else{ ?>
			<h2 class='title error'>无接收数据</h2>
			<?php } ?>
		</form>
		</div>
	</div>

	<?php common_footer(); ?>
</body>
</html>