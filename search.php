<!doctype html>
<html>
<head>
	<?php require('model.php');
		common_head();
	 ?>
	<title>搜索结果</title>
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
			<h2 class='title'>搜索结果
			</h2>
			
			<div class='listhead'>
				<div class='lhcontent'>
					<div class='quser'>
						用户
					</div>
					<div class='qtitle'>标题</div>
				</div>
				<div class='qstat'>
					<div class='upvotestat'>赞</div>
					<div class='downvotestat'>贬</div>
					<div class='starstat'>收藏</div>
				</div>
			</div>
				<!-- question display block -->
			<?php for($qiter=0;$qiter<10;$qiter++){?>
			<div class='item'>
				<div class='qcontent'>
					<div class='quser'>
						<img src="image/avator.jpg" class='qavator'>
					</div>
					<div class='qtitle'><p>怎么使用jQuery来实现Ajax?</p>
						<a class='tag' href='#'>jQuery</a>
						<a class='tag' href='#'>Ajax</a>
					</div>
				</div>
				<div class='qstat'>
					<div class='upvotestat'>15</div>
					<div class='downvotestat'>15</div>
					<div class='starstat'>15</div>
				</div>
			</div>
			<?php }?>
				<!-- question display block -->

			<div id='qnav'class='nav button-group'>
				<a id='prev_page'class='button pill icon arrowleft disable' href='#'>上一页</a>
				<!-- Page display block -->
				<!-- current page --><a  class='pageid button pill primary' href='#'>1</a>
				<a class='pageid button pill' href='#'>2</a>
				<a class='pageid button pill' href='#'>3</a>
				<a class='pageid button pill' href='#'>4</a>
				<a class='pageid button pill' href='#'>5</a>
				<a class='pageid button pill' href='#'>6</a>
				<a class='pageid button pill' href='#'>7</a>
				<a class='pageid button pill' href='#'>8</a>
				<a class='pageid button pill' href='#'>9</a>
				<a class='pageid button pill' href='#'>10</a>
				<!-- Page display block -->
				<a id='next_page' class='button pill icon arrowright' href='#'>下一页</a>
			</div>
		</div>
		</div>
	</div>

	<?php common_footer(); ?>
</body>
</html>