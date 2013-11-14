<!doctype html>
<?php 
?>
<html>
<head>
	<?php require('model.php'); common_head(); ?>
<title>Tags</title>

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
			
			<div class='box'>
				<h2 class='title'>所有标签
				</h2>
				<?php
				$tags = query_tags();
				foreach ($tags as $tag) {
					?>
					<a class='tag big' href=<?php echo "'tag.php?tag=".$tag."'"; ?>
					><?php echo $tag; ?></a>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php common_footer(); ?>
</body>