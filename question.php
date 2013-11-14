<!doctype html>
<?php
	require('model.php');
	$question=false;
	if(isset($_GET['qid'])){
		$question=query_question_by_qid($_GET['qid']);
		$quser=query_user_by_uid($question['uid']);
	}
	$uid=0;
	if(is_logged()){
		$uid=$_COOKIE['uid'];
	}
?>
<html>
<head>
	<?php
	common_head();
	editor_require();
	editor_display();
	?>
	<title>有谁知道
		<?php if($question){echo ':'.$question['title'];} ?>
	</title>
	<script language='javascript' src='/question.js'></script>
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
		<div class='box' id='question' qid=<?php echo "'".$question['qid']."'"; ?>>
			<div class='qcontent'>
				<a class='quser' href=<?php echo "user.php?uid=".$question['uid']; ?>>
					<img src=<?php echo "'".get_avator($quser)."'"; ?> class='qavator'>
				</a>
				<div class='qtitle'>

					<?php if(!$question){ ?>

					<p><span class='sitename'>有谁<b>知道</b>:</span>怎么使用jQuery来实现Ajax?</p>
					<p class='question content'>RT</p>
					<p class='question content'>RT</p>
					<a class='tag' href='#'>jQuery</a>
					<a class='tag' href='#'>Ajax</a>

					<?php }else{ ?>

					<p><span class='sitename'>有谁<b>知道</b>:</span><?php echo $question['title']; ?></p>
					<div class='question author'><?php echo query_user_by_uid($question['uid'])['name']; ?></div>
					<div class='question content'><?php echo $question['content']; ?></div>

					<?php } ?><?php
					$tags = json_decode($question['tags']);
					if(is_array($tags))
						foreach($tags as $value){ ?>
						<a class='tag' href=<?php echo "'tag.php?tag=".$value."'"; ?>><?php echo $value; ?></a>
					<?php } ?>

				</div>
			</div>
			<div class='qstat'>
				<div><p class='stat button primary upvote question'><?php echo query_upvote_string_by_qid($uid,$question['qid']); ?></p></div>
				<div><p class='stat button danger downvote question'><?php echo query_downvote_string_by_qid($uid,$question['qid']); ?></p></div>
				<div><p class='stat button star question'><?php echo query_star_string_by_qid($uid,$question['qid']); ?></p></div>
				<div><p id='answer' class='stat button primary'>回答<br>问题</p></div>
				<?php if($question['uid']==$uid){ ?>
				<div><p id='delete' class='stat button danger'>删除<br>问题</p></div>
				<?php } ?>
			</div>
			<div class='clearfix'></div>
		</div>
		<br>
		<div class='box'>
			<?php
				$answers=query_answers_by_qid($question['qid']);
				$count=count($answers);
				$hasAccepted = false;
				if($accepted=query_accepted_answer($question['qid'])){
					$hasAccepted = true;
				$count--;
			?>
			<h3>被采纳回答</h3>
			<div class='aitem' aid=<?php echo "'".$accepted['aid']."'"; ?> >
				<div class='acontent'>
					<a class='auser' href=<?php echo "user.php?uid=".$accepted['uid']; ?>>
						<img src=<?php echo "'".get_avator(query_user_by_uid($accepted['uid']))."'"; ?> class='qavator'>
					</a>
					<div class='atitle'>
						<div class='author'><?php echo query_user_by_uid($accepted['uid'])['name']; ?></div>
						<div class='content'><?php echo $accepted['content']; ?></div>
						
						<?php $improvements=query_improvements_by_aid($accepted['aid']);
								foreach ($improvements as $improvement) {
						?>
						<div class='improvement' iid=<?php echo "'".$improvement['iid']."'"; ?>>
							<a class='iuser' href=<?php echo "user.php?uid=".$improvement['uid']; ?>>
								<img src=<?php echo "'".get_avator(query_user_by_uid($improvement['uid']))."'"; ?> class='qavator'>
							</a>
							<div class='ititle'>
								<div class='author'><?php echo query_user_by_uid($improvement['uid'])['name']; ?>
									<?php if($improvement['uid']==$uid){ ?>
									<p class='delete improv'>删除</p>
									<?php } ?>
								</div>
								<div class='content'><?php echo $improvement['content']; ?></div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class='astat'>
					<div><p class='stat button primary upvote answer'><?php echo query_upvote_string_by_aid($uid,$accepted['aid']); ?></p></div>
					<div><p class='stat button danger downvote answer'><?php echo query_downvote_string_by_aid($uid,$accepted['aid']); ?></p></div>
					<div><p class='stat button improv'>补充<br><?php echo count($improvements); ?></p></div>
				</div>
			</div>
			<?php } ?>
			<?php if($count>0){ ?>
			<h3>精选回答(<?php echo $count; ?>)</h3>
			<?php } ?>
			<?php foreach ($answers as $answer)
					if($answer['aid']!=$accepted['aid']) {
			?>
			<div class='aitem' aid=<?php echo "'".$answer['aid']."'"; ?> >
				<div class='acontent'>
					<a class='auser' href=<?php echo "user.php?uid=".$answer['uid']; ?>>
						<img src=<?php echo "'".get_avator(query_user_by_uid($answer['uid']))."'"; ?> class='qavator'>
					</a>
					<div class='atitle'>
						<div class='author'><?php echo query_user_by_uid($answer['uid'])['name']; ?></div>
						<div class='content'><?php echo $answer['content']; ?></div>
						
						<?php $improvements=query_improvements_by_aid($answer['aid']);
								foreach ($improvements as $improvement) {
						?>
						<div class='improvement' iid=<?php echo "'".$improvement['iid']."'"; ?>>
							<a class='iuser' href=<?php echo "user.php?uid=".$improvement['uid']; ?>>
								<img src=<?php echo "'".get_avator(query_user_by_uid($improvement['uid']))."'"; ?> class='qavator'>
							</a>
							<div class='ititle'>
								<div class='author'><?php echo query_user_by_uid($improvement['uid'])['name']; ?>
									<?php if($improvement['uid']==$uid){ ?>
									<p class='delete improv'>删除</p>
									<?php } ?>
								</div>
								<div class='content'><?php echo $improvement['content']; ?></div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class='astat'>
					<div><p class='stat button primary upvote answer'><?php echo query_upvote_string_by_aid($uid,$answer['aid']); ?></p></div>
					<div><p class='stat button danger downvote answer'><?php echo query_downvote_string_by_aid($uid,$answer['aid']); ?></p></div>
					<div><p class='stat button improv'>补充<br><?php echo count($improvements); ?></p></div>
					<?php if(($question['uid']==$uid)&&!$hasAccepted){ ?>
					<div><p class='stat button primary accept answer'>采纳<br>回答</p></div>
					<?php } if($answer['uid']==$uid){ ?>
					<div><p class='stat button danger delete answer'>删除<br>回答</p></div>
					<?php } ?>
				</div>
			</div>
			<div class='clearfix'></div>
			<?php } ?>
		</div>
		<br>
		<div class='box' id='reply'>
			<div class='button danger pill' id='edit-close'>关闭编辑栏</div>
			<div id="replylabel"></div>
			<form id="replyform" action="">
				<input type='hidden' id='replyid' name='id' value='none'>
				<script type='text/plain' name="newcontent" id="myEditor" ></script>
				<br>
				<input id='newsubmit' type='submit' name='send' value='提交 Submit' class='button primary'>
			</form>
		</div>
		</div>
	</div>
	<?php common_footer(); ?>
</body>
</html>