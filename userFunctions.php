<?php
require('model.php');
function get_user_questions($uid){
	?>
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
	<?php $questions = query_questions_by_uid($uid);
		foreach ($questions as $question) {
	?>
	<div class='item'>
		<div class='qcontent'>
			<a class='quser' href=<?php echo "user.php?uid=".$question['uid']; ?>>
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
	<?php
}
function get_user_starred_questions($uid){
	?>
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
	<?php $questions = query_starred_questions_by_uid($uid);
		foreach ($questions as $question) {
	?>
	<div class='item'>
		<div class='qcontent'>
			<a class='quser' href=<?php echo "user.php?uid=".$question['uid']; ?>>
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
	<?php
}

function get_user_answers($uid){
	?>
	<div class='listhead'>
		<div class='lhcontent'>
			<div class='quser'>
				用户
			</div>
			<div class='qtitle'>回答</div>
		</div>
		<div class='preview qstat'>
			<div class='upvotestat'>赞</div>
			<div class='downvotestat'>贬</div>
			<div class='starstat'>补充</div>
		</div>
	</div>
	<?php $answers = query_answers_by_uid($uid);
		foreach ($answers as $answer) {
	?>
	<div class='item'>
		<div class='qcontent'>
			<a class='quser' href=<?php echo "user.php?uid=".$answer['uid']; ?>>
				<img src=<?php echo "'".get_avator(query_user_by_uid($answer['uid']))."'"; ?> class='qavator'>
			</a>
			<div class='qtitle'><div class='content independent'><?php echo $answer['content']; ?></div>
			<span>in 问题:</span><a class='tag big' href=<?php echo "'question.php?qid=".$answer['qid']."'"; ?>><?php echo query_question_by_qid($answer['qid'])['title']; ?></a>

			</div>
		</div>
		<div class='preview qstat'>
			<div class='upvotestat'><?php echo query_upvote_by_qid($answer['qid']); ?></div>
			<div class='downvotestat'><?php echo query_downvote_by_qid($answer['qid']); ?></div>
			<div class='starstat'><?php echo query_star_by_qid($answer['qid']); ?></div>
		</div>
	</div>
	<?php } ?>
	<?php
}
function get_user_bonus_record($uid){
	$dates = query_bonusdate_by_uid($uid);
	rsort($dates);
	foreach ($dates as $date) {
	?>
	<div class='item no-hover'>
        <h3><?php echo date('Y年m月d日',strtotime($date)); ?></h3>

		<?php
			$times_q = query_time_question_by_date($uid,$date);
			rsort($times_q);
			$times_a = query_time_answer_by_date($uid,$date);
			rsort($times_a);
			$times_i = query_time_improvement_by_date($uid,$date);
			rsort($times_i);
			$times_uq = query_time_upvote_question_by_date($uid,$date);
			rsort($times_uq);
			$times_dq = query_time_downvote_question_by_date($uid,$date);
			rsort($times_dq);

			$times_ua = query_time_upvote_answer_by_date($uid,$date);
			rsort($times_ua);
			$times_da = query_time_downvote_answer_by_date($uid,$date);
			rsort($times_da);
			$times_sd = query_time_starred_by_date($uid,$date);
			rsort($times_sd);
			$times_uqd = query_time_upvoted_question_by_date($uid,$date);
			rsort($times_uqd);
			$times_dqd = query_time_downvoted_question_by_date($uid,$date);
			rsort($times_dqd);

			$times_uad = query_time_upvoted_answer_by_date($uid,$date);
			rsort($times_uad);
			$times_dad = query_time_downvoted_answer_by_date($uid,$date);
			rsort($times_dad);
			$times_ac = query_time_accept_by_date($uid,$date);
			rsort($times_ac);
			$times_acd = query_time_accepted_by_date($uid,$date);
			rsort($times_acd);

			$times=array();

			add_all_to_set($times_q,$times);
			add_all_to_set($times_a,$times);
			add_all_to_set($times_i,$times);
			add_all_to_set($times_uq,$times);
			add_all_to_set($times_dq,$times);

			add_all_to_set($times_ua,$times);
			add_all_to_set($times_da,$times);
			add_all_to_set($times_sd,$times);
			add_all_to_set($times_uqd,$times);
			add_all_to_set($times_dqd,$times);

			add_all_to_set($times_uad,$times);
			add_all_to_set($times_dad,$times);
			add_all_to_set($times_ac,$times);
			add_all_to_set($times_acd,$times);

			rsort($times);
			foreach ($times as $time) {
				while(count($times_acd)>0){ $time_acd=array_shift($times_acd);
					if($time_acd==$time){ bonus_acd($time_acd); }else{ array_unshift($times_acd, $time_acd); break; }
				}while(count($times_ac)>0){ $time_ac=array_shift($times_ac);
					if($time_ac==$time){ bonus_ac($time_ac); }else{ array_unshift($times_ac, $time_ac); break; }
				}while(count($times_q)>0){ $time_q=array_shift($times_q);
					if($time_q==$time){ bonus_q($time_q); }else{ array_unshift($times_q, $time_q); break; }
				}while(count($times_sd)>0){ $time_sd=array_shift($times_sd);
					if($time_sd==$time){ bonus_sd($time_sd); }else{ array_unshift($times_sd, $time_sd); break; }
				}while(count($times_a)>0){ $time_a=array_shift($times_a);
					if($time_a==$time){ bonus_a($time_a); }else{ array_unshift($times_a, $time_a); break; }
				}while(count($times_uqd)>0){ $time_uqd=array_shift($times_uqd);
					if($time_uqd==$time){ bonus_uqd($time_uqd); }else{ array_unshift($times_uqd, $time_uqd); break; }
				}while(count($times_uad)>0){ $time_uad=array_shift($times_uad);
					if($time_uad==$time){ bonus_uad($time_uad); }else{ array_unshift($times_uad, $time_uad); break; }
				}while(count($times_i)>0){ $time_i=array_shift($times_i);
					if($time_i==$time){ bonus_i($time_i); }else{ array_unshift($times_i, $time_i); break; }
				}while(count($times_uq)>0){ $time_uq=array_shift($times_uq);
					if($time_uq==$time){ bonus_uq($time_uq); }else{ array_unshift($times_uq, $time_uq); break; }
				}while(count($times_ua)>0){ $time_ua=array_shift($times_ua);
					if($time_ua==$time){ bonus_ua($time_ua); }else{ array_unshift($times_ua, $time_ua); break; }
				}while(count($times_dq)>0){ $time_dq=array_shift($times_dq);
					if($time_dq==$time){ bonus_dq($time_dq); }else{ array_unshift($times_dq, $time_dq); break; }
				}while(count($times_da)>0){ $time_da=array_shift($times_da);
					if($time_da==$time){ bonus_da($time_da); }else{ array_unshift($times_da, $time_da); break; }
				}while(count($times_dqd)>0){ $time_dqd=array_shift($times_dqd);
					if($time_dqd==$time){ bonus_dqd($time_dqd); }else{ array_unshift($times_dqd, $time_dqd); break; }
				}while(count($times_dad)>0){ $time_dad=array_shift($times_dad);
					if($time_dad==$time){ bonus_dad($time_dad); }else{ array_unshift($times_dad, $time_dad); break; }
				}
			}
		?>
    </div>
	<?php
	} 
}

function add_all_to_set(&$source, &$target){
	foreach ($source as $si) {
		if(!in_array($si, $target))
			array_push($target, $si);
	}
}

function bonus_q($time){
?>
<p class='bonus_item bonus_q'>
	<span class="bonus_value">+5</span>
	<span class="bonus_string">提出了一个问题 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_a($time){
?>
<p class='bonus_item bonus_a'>
	<span class="bonus_value">+2</span>
	<span class="bonus_string">回答了一个问题 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_i($time){
?>
<p class='bonus_item bonus_i'>
	<span class="bonus_value">+1</span>
	<span class="bonus_string">补充了一个回答 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_uq($time){
?>
<p class='bonus_item bonus_uq'>
	<span class="bonus_value">+2</span>
	<span class="bonus_string">赞了一个问题 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_dq($time){
?>
<p class='bonus_item bonus_dq'>
	<span class="bonus_value">-1</span>
	<span class="bonus_string">贬了一个问题 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}

function bonus_ua($time){
?>
<p class='bonus_item bonus_ua'>
	<span class="bonus_value">+2</span>
	<span class="bonus_string">赞了一个回答 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_da($time){
?>
<p class='bonus_item bonus_da'>
	<span class="bonus_value">-1</span>
	<span class="bonus_string">贬了一个回答 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_sd($time){
?>
<p class='bonus_item bonus_sd'>
	<span class="bonus_value">+5</span>
	<span class="bonus_string">一个问题被收藏了 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_uqd($time){
?>
<p class='bonus_item bonus_uqd'>
	<span class="bonus_value">+5</span>
	<span class="bonus_string">一个问题被赞了 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_dqd($time){
?>
<p class='bonus_item bonus_dqd'>
	<span class="bonus_value">-2</span>
	<span class="bonus_string">一个问题被贬了 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}

function bonus_uad($time){
?>
<p class='bonus_item bonus_uad'>
	<span class="bonus_value">+5</span>
	<span class="bonus_string">一个回答被赞了 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_dad($time){
?>
<p class='bonus_item bonus_dad'>
	<span class="bonus_value">-2</span>
	<span class="bonus_string">一个回答被贬了 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_ac($time){
?>
<p class='bonus_item bonus_ac'>
	<span class="bonus_value">+5</span>
	<span class="bonus_string">采纳了一个回答 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_acd($time){
?>
<p class='bonus_item bonus_acd'>
	<span class="bonus_value">+10</span>
	<span class="bonus_string">一个回答被采纳了 - <?php echo bonus_time($time); ?></span>
</p>
<?php
}
function bonus_time($time){
	return date('H时i分s秒',strtotime($time));
}


if(isset($_POST['list'])){
	$list=$_POST['list'];
	$uid=$_POST['uid'];
	if($list=='questions')
		get_user_questions($uid);
	else if($list=='answers')
		get_user_answers($uid);
	else if($list=='bonus')
		get_user_bonus_record($uid);
	else if($list=='star')
		get_user_starred_questions($uid);
}

?>