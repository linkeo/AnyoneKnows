<!doctype html>
<?php
	require('model.php');
	$question=false;
	if(isset($_GET['qid'])){
		$question=query_question_by_qid($_GET['qid']);
		$quser=query_user_by_uid($question['uid']);
	}
?>
<html>
<head>
	<?php
	common_head();
	editor_display();
	?>
	<title>有谁知道
		<?php if($question){echo ':'.$question['title'];} ?>
	</title>
</head>
<body>
	<nav> <?php common_nav(); ?> </nav>
	<div class='site'>
		<div class='pagehead container'>
			<h1 class='sitename'>Anyone<b>Knows</b></h1>
			<?php if(!$question){ ?>
			<h3 class='error'>示例</h3>
			<?php } ?>
		</div>
		<div class='container'>
		<div class='box'>
				<div class='qcontent'>
					<div class='quser'>
						<img src="image/avator.jpg" class='qavator'>
					</div>
					<div class='qtitle'>

						<?php if(!$question){ ?>

						<p><span class='sitename'>有谁<b>知道</b>:</span>怎么使用jQuery来实现Ajax?</p>
						<p class='question content'>RT</p>
						<a class='tag' href='#'>jQuery</a>
						<a class='tag' href='#'>Ajax</a>

						<?php }else{ ?>

						<p><span class='sitename'>有谁<b>知道</b>:</span><?php echo $question['title']; ?></p>
						<div class='question content'><?php echo $question['content']; ?></div>

						<?php } ?><?php
						$tags = json_decode($question['tags']);
						if(is_array($tags))
							foreach($tags as $value){ ?>
							<a class='tag' href='#'><?php echo $value; ?></a>
						<?php } ?>

					</div>
				</div>
				<div class='qstat'>
					<div class='upvotestat'><p class='stat button primary'>赞<br>15</p></div>
					<div class='downvotestat'><p class='stat button'>贬<br>15</p></div>
					<div class='starstat'><p class='stat button danger'>收藏<br>15</p></div>
					<div class='answer'><p id='answer'class='button'>回答</p></div>
				</div>
		</div>
		<br>
		<div class='box'>
			<h3>精选回答</h3>
			<?php for($answeriter=0;$answeriter<5;$answeriter++){ ?>
			<div class='aitem'>
				<div class='acontent'>
					<div class='auser'>
						<img src="image/avator.jpg" class='qavator'>
					</div>
					<div class='atitle'>
						<p class='content'>用$.post(url,data,success)<br>其中url为请求接收地址, data为POST数据,JSON格式, success为回调函数,可带一个参数为返回的数据</p>
						<div class='improvement'>
							<div class='iuser'>
								<img src="image/avator.jpg" class='qavator'>
							</div>
							<div class='ititle'>
								<p class='content'>也可以用$.get(url,success)或$.ajax, 不过$.ajax就比较复杂了, 要用的话还是自己Google吧.</p>
							</div>
						</div>
						<div class='improvement'>
							<div class='iuser'>
								<img src="image/avator.jpg" class='qavator'>
							</div>
							<div class='ititle'>
								<p class='content'>谢谢~~~已用$.post解决</p>
							</div>
						</div>
					</div>
				</div>
				<div class='astat'>
					<div class='upvotestat'><p class='stat button primary'>赞<br>15</p></div>
					<div class='downvotestat'><p class='stat button'>贬<br>15</p></div>
					<div class='improvestat'><p class='stat button danger'>补充<br>15</p></div>
				</div>
			</div>
			<?php } ?>
		</div>
		</div>
		<div class='container' id='reply'>
		</div>
	</div>
	<?php common_footer(); ?>
</body>
</html>