<!DOCTYPE HTML>
<html>
<head>
	<?php require('model.php'); common_head(); ?>
<title>AnyoneKnows</title>

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
			<div class='left-container'>
				<div class='box'>
					<h2 class='title'>精选问题
					</h2>
					
					<div class='listhead'>
						<div class='lhcontent'>
							<div class='quser'>
								用户
							</div>
							<div class='qtitle'>标题</div>
						</div>
						<div class='preview qstat'>
							<div class='upvotestat'>赞</div>
							<div class='downvotestat'>贬</div>
							<div class='starstat'>收藏</div>
						</div>
					</div>
						<!-- question display block -->
					<?php $questions = query_questions_by_keyword("");
						foreach ($questions as $question) {
					?>
					<div class='item'>
						<div class='qcontent'>
							<a class='quser' href=<?php echo "user.php?uid=".$question['uid']; ?> >
								<img src=<?php echo "'".get_avator(query_user_by_uid($question['uid']))."'"; ?> class='qavator'>
							</a>
							<div class='qtitle'><p><a href=<?php echo "'question.php?qid=".$question['qid']."'"; ?>><?php echo $question['title']; ?></a></p>
								<?php
								$tags = json_decode($question['tags']);
								if(is_array($tags))
									foreach($tags as $value){ ?>
									<a class='tag' href=<?php echo "'tag.php?tag=".$value."'"; ?>><?php echo $value; ?></a>
								<?php } ?>
							</div>
						</div>
						<div class='preview qstat'>
							<div class='upvotestat'><?php echo query_upvote_by_qid($question['qid']); ?></div>
							<div class='downvotestat'><?php echo query_downvote_by_qid($question['qid']); ?></div>
							<div class='starstat'><?php echo query_star_by_qid($question['qid']); ?></div>
						</div>
					</div>
					<?php }?>
						<!-- question display block -->

					<!-- <div id='qnav'class='nav button-group'> -->
						<!-- <a id='prev_page'class='button pill icon arrowleft disable' href='#'>上一页</a> -->
						<!-- Page display block -->
						<!-- current page<a  class='pageid button pill primary' href='#'>1</a> -->
						<!-- <a class='pageid button pill' href='#'>2</a> -->
						<!-- <a class='pageid button pill' href='#'>3</a> -->
						<!-- <a class='pageid button pill' href='#'>4</a> -->
						<!-- <a class='pageid button pill' href='#'>5</a> -->
						<!-- <a class='pageid button pill' href='#'>6</a> -->
						<!-- <a class='pageid button pill' href='#'>7</a> -->
						<!-- <a class='pageid button pill' href='#'>8</a> -->
						<!-- <a class='pageid button pill' href='#'>9</a> -->
						<!-- <a class='pageid button pill' href='#'>10</a> -->
						<!-- Page display block -->
						<!-- <a id='next_page' class='button pill icon arrowright' href='#'>下一页</a> -->
					<!-- </div> -->
				</div>
			</div>
			<aside>
				<div class='box'>
						<!-- hot tag display block -->
					<h3 class='title'>热门标签</h3>

					<?php
					$tags = query_tags();
					foreach ($tags as $tag) {
						?>
						<a class='tag' href=<?php echo "'tag.php?tag=".$tag."'"; ?>
						><?php echo $tag; ?></a>
						<?php
					}
					?>
						<!-- hot tag display block -->
				</div>
			</aside>
		</div>
	</div>
	<?php common_footer(); ?>
</body>