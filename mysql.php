<?php

	function connect(){
		$db_host='localhost';
		$db_user='root';
		$db_password='141592653';
		$db_schema='anyoneknows';
		$connect=mysql_connect($db_host,$db_user,$db_password);
		mysql_query("set names utf8");
		mysql_select_db($db_schema);
	}

	//用户

	function check_exist_user($username){
		connect();
		$query="select username from user where username = '$username'";
		$result=mysql_query($query);
		if(mysql_fetch_assoc($result)){
			mysql_free_result($result);
			return true;
		}else{
			mysql_free_result($result);
			return false;
		}
	}

	function check_exist_email($email){
		connect();
		$query="select email from user where email = '$email'";
		$result=mysql_query($query);
		if(mysql_fetch_assoc($result)){
			mysql_free_result($result);
			return true;
		}else{
			mysql_free_result($result);
			return false;
		}
	}

	function register_user($username, $password, $name, $email, $gender){
		$exists = check_exist_user($username);
		if($exists)
			return 'username';
		$exists = check_exist_email($email);
		if($exists)
			return 'email';
		connect();
		$query="insert into user(username, password, name, email, gender) values ('$username','$password','$name','$email','$gender')";
		if(mysql_query($query))
			return 'success';
		else
			return 'fail';
	}

	function login_user($username, $password){
		$exists = check_exist_user($username);
		if(!$exists)
			return 'username';
		connect();
		$query="select uid from user where username = '$username' and password = '$password'";
		$result=mysql_query($query);
		$user=mysql_fetch_assoc($result);
		mysql_free_result($result);
		if($user)
			return $user;
		else
			return 'password';
	}
	function update_user($uid,$avator,$name,$website,$location){
		connect();
		$query="update user set avator=$avator, name='$name', website='$website', location='$location' where uid=$uid";
		if(mysql_query($query))
			return 'success';
		else
			return 'fail';
	}

	function query_user_by_uid($uid){
		connect();
		$query="select * from user where uid=$uid";
		$result=mysql_query($query);
		$user=mysql_fetch_assoc($result);
		mysql_free_result($result);
		if($user)
			return $user;
		else
			return false;
	}

	function query_user_by_username($username){
		connect();
		$query="select * from user where username='$username'";
		$result=mysql_query($query);
		$user=mysql_fetch_assoc($result);
		mysql_free_result($result);
		if($user)
			return $user;
		else
			return false;
	}

	function query_users(){
		connect();
		$query="select * from user";
		$result=mysql_query($query);
		$users=array();
		$index=0;
		while($user=mysql_fetch_assoc($result)){
			$users[$index++]=$user;
		}
		return $users;
	}

	//问答补充

	function insert_question($uid, $title, $content, $tags){
		connect();
		$query="insert into question(uid, title, content, tags) values ($uid,'$title','$content','$tags')";
		if(mysql_query($query))
			return query_question_by_uid($uid, $title);
		else
			return false;
	}

	function insert_answer($uid, $qid, $content){
		connect();
		$query="insert into answer(uid, qid, content) values ($uid, $qid,'$content')";
		if(mysql_query($query))
			return true;
		else
			return false;
	}

	function insert_improvement($uid, $aid, $content){
		connect();
		$query="insert into improvement(uid, aid, content) values ($uid, $aid,'$content')";
		if(mysql_query($query))
			return true;
		else
			return false;
	}

	function query_question_by_qid($qid){
		connect();
		$query="select * from question where qid=$qid";
		$result=mysql_query($query);
		$question=mysql_fetch_assoc($result);
		mysql_free_result($result);
		if($question)
			return $question;
		else
			return false;
	}
	function query_questions_by_tag($tag){
		connect();
		$query="select * from question where tags like '%\"$tag\"%'";
		$result=mysql_query($query);
		$questions=array();
		$index=0;
		while($question=mysql_fetch_assoc($result)){
			$questions[$index++]=$question;
		}
		return $questions;
	}
	function query_questions_by_keyword($keyword){
		connect();
		$query="select * from question where tags like '%$keyword%' or title like '%$keyword%' or content like '%$keyword%'";
		$result=mysql_query($query);
		$questions=array();
		$index=0;
		while($question=mysql_fetch_assoc($result)){
			$questions[$index++]=$question;
		}
		return $questions;
	}
	function query_question_by_uid($uid, $title){
		connect();
		$query="select qid from question where uid=$uid and title='$title'";
		$result=mysql_query($query);
		$question=mysql_fetch_assoc($result);
		mysql_free_result($result);
		if($question)
			return $question;
		else
			return false;
	}

	function query_questions_by_uid($uid){
		connect();
		$query="select * from question where uid=$uid";
		$result=mysql_query($query);
		$questions = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$questions[$i++]=$row;
		return $questions;
	}

	function query_starred_questions_by_uid($uid){
		connect();
		$query="select question.* from question,star where question.qid=star.qid and star.uid=$uid";
		$result=mysql_query($query);
		$questions = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$questions[$i++]=$row;
		return $questions;
	}

	function query_answers_by_qid($qid){
		connect();
		$query="select * from answer where qid=$qid";
		$result = mysql_query($query);
		$answers = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$answers[$i++]=$row;
		return $answers;
	}

	function query_answers_by_uid($uid){
		connect();
		$query="select * from answer where uid=$uid";
		$result = mysql_query($query);
		$answers = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$answers[$i++]=$row;
		return $answers;
	}

	function query_improvements_by_aid($aid){
		connect();
		$query="select * from improvement where aid=$aid";
		$result = mysql_query($query);
		$improvs = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$improvs[$i++]=$row;
		return $improvs;
	}

	function query_tags(){
		connect();
		$query="select tags from question";
		$result=mysql_query($query);
		$tags=array();
		$index=0;
		while($tag=mysql_fetch_assoc($result)){
			$tagj = json_decode($tag['tags']);
			if(is_array($tagj))
			foreach ($tagj as $value) {
				if(!in_array($value, $tags))
					$tags[$index++]=$value;
			}
		}
		return $tags;
	}

	function delete_question($uid,$qid){
		connect();
		$query="delete from question where uid=$uid and qid=$qid";
		if(mysql_query($query))
			return 'success';
		else
			return 'fail';
	}
	function delete_answer($uid,$aid){
		connect();
		$query="delete from answer where uid=$uid and aid=$aid";
		if(mysql_query($query))
			return 'success';
		else
			return 'fail';
	}
	function delete_improvement($uid,$iid){
		connect();
		$query="delete from improvement where uid=$uid and iid=$iid";
		if(mysql_query($query))
			return 'success';
		else
			return 'fail';
	}
	function accept_answer($uid,$qid,$aid){
		connect();
		$query="select count(*) from question,answer where question.uid=$uid and question.qid=$qid and question.qid=answer.qid and answer.aid=$aid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($row[0]==1){
				$exist = exist_acception($qid);
				if($exist=='none'){
					$query="insert into accept(qid,aid) values($qid,$aid)";
					if(mysql_query($query))
						return 'success';
					else
						return 'exist';
				}else
					return 'fail';
			}else
				return 'fail';
		}else
			return 'fail';
	}
	function exist_acception($qid){
		connect();
		$query="select count(*) from accept where qid=$qid";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($row[0]>0)
				return 'exist';
			else
				return 'none';
		}
		return 'fail';
	}
	function query_accepted_answer($qid){
		connect();
		$query="select answer.* from answer,accept where answer.aid=accept.aid and accept.qid=answer.qid and accept.qid=$qid";
		$result=mysql_query($query);
		$answer=mysql_fetch_assoc($result);
		mysql_free_result($result);
		if($answer)
			return $answer;
		else
			return false;
	}

	//赞贬收藏
	function query_exist_vote($uid, $type, $vect, $id){
		if($type=='s'){
			$query = "select count(*) from star where qid=$id and uid = $uid";
		}else{
			if($type=='q'){
				$ids = 'qid';
				$ts = 'question';
			}else if($type=='a'){
				$ids = 'aid';
				$ts = 'answer';
			}
			$query = "select count(*) from $vect"."_"."$ts where $ids=$id and uid=$uid";
		}
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return ($row[0]>0);
		else
			return 'fail';
	}

	function query_upvote_by_qid($qid){
		connect();
		$query="select count(*) from upvote_question where qid=$qid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}

	function query_upvote_string_by_qid($uid,$qid){
		connect();
		$exist=query_exist_vote($uid,'q','upvote',$qid);
		$query="select count(*) from upvote_question where qid=$qid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($exist)
				return '已赞<br>'.$row[0];
			else
				return '赞<br>'.$row[0];
		}
		else
			return 'fail';
	}

	function query_downvote_by_qid($qid){
		connect();
		$query="select count(*) from downvote_question where qid=$qid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function query_downvote_string_by_qid($uid,$qid){
		connect();
		$exist=query_exist_vote($uid,'q','downvote',$qid);
		$query="select count(*) from downvote_question where qid=$qid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($exist)
				return '已贬<br>'.$row[0];
			else
				return '贬<br>'.$row[0];
		}
		else
			return 'fail';
	}

	function query_star_by_qid($qid){
		connect();
		$query="select count(*) from star where qid=$qid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}

	function query_star_string_by_qid($uid,$qid){
		connect();
		$exist=query_exist_vote($uid,'s','star',$qid);
		$query="select count(*) from star where qid=$qid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($exist)
				return '已收<br>'.$row[0];
			else
				return '收藏<br>'.$row[0];
		}
		else
			return 'fail';
	}

	function query_upvote_by_aid($aid){
		connect();
		$query="select count(*) from upvote_answer where aid=$aid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}

	function query_upvote_string_by_aid($uid,$aid){
		connect();
		$exist=query_exist_vote($uid,'a','upvote',$aid);
		$query="select count(*) from upvote_answer where aid=$aid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($exist)
				return '已赞<br>'.$row[0];
			else
				return '赞<br>'.$row[0];
		}
		else
			return 'fail';
	}

	function query_downvote_by_aid($aid){
		connect();
		$query="select count(*) from downvote_answer where aid=$aid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}

	function query_downvote_string_by_aid($uid,$aid){
		connect();
		$exist=query_exist_vote($uid,'a','downvote',$aid);
		$query="select count(*) from downvote_answer where aid=$aid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($exist)
				return '已贬<br>'.$row[0];
			else
				return '贬<br>'.$row[0];
		}
		else
			return 'fail';
	}

	function upvote_question($uid,$qid){
		connect();
		$query="select count(*) from question where qid=$qid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($row[0]==1)
				return 'self';
		}else{
			return 'fail';
		}
		$query="select * from downvote_question where qid=$qid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			return 'forbid';
		}
		$query="select * from upvote_question where qid=$qid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			$query="delete from upvote_question where qid=$qid and uid=$uid";
			if(mysql_query($query))
				return query_upvote_string_by_qid($uid,$qid);
			else
				return 'fail';
		}else{
			$query="insert into upvote_question(uid, qid) values ($uid, $qid)";
			if(mysql_query($query))
				return query_upvote_string_by_qid($uid,$qid);
			else
				return 'fail';
		}
	}

	function downvote_question($uid,$qid){
		connect();
		$query="select count(*) from question where qid=$qid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($row[0]==1)
				return 'self';
		}else{
			return 'fail';
		}
		$query="select * from upvote_question where qid=$qid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			return 'forbid';
		}
		$query="select * from downvote_question where qid=$qid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			$query="delete from downvote_question where qid=$qid and uid=$uid";
			if(mysql_query($query))
				return query_downvote_string_by_qid($uid,$qid);
			else
				return 'fail';
		}else{
			$query="insert into downvote_question(uid, qid) values ($uid, $qid)";
			if(mysql_query($query))
				return query_downvote_string_by_qid($uid,$qid);
			else
				return 'fail';
		}
	}

	function star_question($uid,$qid){
		connect();
		$query="select * from star where qid=$qid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			$query="delete from star where qid=$qid and uid=$uid";
			if(mysql_query($query))
				return query_star_string_by_qid($uid,$qid);
			else
				return 'fail';
		}else{
			$query="insert into star(uid, qid) values ($uid, $qid)";
			if(mysql_query($query))
				return query_star_string_by_qid($uid,$qid);
			else
				return 'fail';
		}
	}

	function upvote_answer($uid,$aid){
		connect();
		$query="select count(*) from answer where aid=$aid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($row[0]==1)
				return 'self';
		}else{
			return 'fail';
		}
		$query="select * from downvote_answer where aid=$aid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			return 'forbid';
		}
		$query="select * from upvote_answer where aid=$aid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			$query="delete from upvote_answer where aid=$aid and uid=$uid";
			if(mysql_query($query))
				return query_upvote_string_by_aid($uid,$aid);
			else
				return 'fail';
		}else{
			$query="insert into upvote_answer(uid, aid) values ($uid, $aid)";
			if(mysql_query($query))
				return query_upvote_string_by_aid($uid,$aid);
			else
				return 'fail';
		}
	}

	function downvote_answer($uid,$aid){
		connect();
		$query="select count(*) from answer where aid=$aid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			if($row[0]==1)
				return 'self';
		}else{
			return 'fail';
		}
		$query="select * from upvote_answer where aid=$aid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			return 'forbid';
		}
		$query="select * from downvote_answer where aid=$aid and uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result)){
			$query="delete from downvote_answer where aid=$aid and uid=$uid";
			if(mysql_query($query))
				return query_downvote_string_by_aid($uid,$aid);
			else
				return 'fail';
		}else{
			$query="insert into downvote_answer(uid, aid) values ($uid, $aid)";
			if(mysql_query($query))
				return query_downvote_string_by_aid($uid,$aid);
			else
				return 'fail';
		}
	}

	//积分相关
	function query_bonus($uid){
		$upA=count_answer_upvote_by_uid($uid);
		$downA=count_answer_downvote_by_uid($uid);
		$upQ=count_question_upvote_by_uid($uid);
		$downQ=count_question_downvote_by_uid($uid);
		$countQ=count_question_by_uid($uid);

		$countA=count_answer_by_uid($uid);
		$countI=count_improvement_by_uid($uid);
		$updQ=count_question_upvoted_by_uid($uid);
		$downdQ=count_question_downvoted_by_uid($uid);
		$updA=count_answer_upvoted_by_uid($uid);

		$downdA=count_answer_downvoted_by_uid($uid);
		$stardQ=count_question_starred_by_uid($uid);
		$accept=count_accept_by_uid($uid);
		$accepted=count_accepted_by_uid($uid);
		//14 items in total

		$bonus	=
				+ 10*$accepted
				+ 5*$accept
				+ 5*$countQ
				+ 5*$stardQ
				+ 5*$updQ
				+ 5*$updA
				+ 2*$countA
				+ 2*$upA
				+ 2*$upQ
				+ 1*$countI
				- 1*$downA
				- 1*$downQ
				- 2*$downdQ
				- 2*$downdA
				;
		return $bonus;
	}


	function count_answer_upvote_by_uid($uid){
		connect();
		$query="select count(*) from upvote_answer where uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}

	function count_answer_downvote_by_uid($uid){
		connect();
		$query="select count(*) from downvote_answer where uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_question_upvote_by_uid($uid){
		connect();
		$query="select count(*) from upvote_question where uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}

	function count_question_downvote_by_uid($uid){
		connect();
		$query="select count(*) from downvote_question where uid=$uid";
		$result = mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}


	function count_question_by_uid($uid){
		connect();
		$query="select count(*) from question where uid=$uid";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_answer_by_uid($uid){
		connect();
		$query="select count(*) from answer where uid=$uid";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_improvement_by_uid($uid){
		connect();
		$query="select count(*) from improvement where uid=$uid";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_question_upvoted_by_uid($uid){
		connect();
		$query="select count(*) from question,upvote_question where question.qid = upvote_question.qid and question.uid = $uid";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_question_downvoted_by_uid($uid){
		connect();
		$query="select count(*) from question,downvote_question where question.qid = downvote_question.qid and question.uid = $uid";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_question_starred_by_uid($uid){
		connect();
		$query="select count(*) from question,star where question.qid = star.qid and question.uid = $uid ";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_answer_upvoted_by_uid($uid){
		connect();
		$query="select count(*) from answer,upvote_answer where answer.aid = upvote_answer.aid and answer.uid = $uid ";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_answer_downvoted_by_uid($uid){
		connect();
		$query="select count(*) from answer,downvote_answer where answer.aid = downvote_answer.aid and answer.uid = $uid ";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_accept_by_uid($uid){
		connect();
		$query="select count(*) from accept,question where question.qid = accept.qid and question.uid = $uid ";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}
	function count_accepted_by_uid($uid){
		connect();
		$query="select count(*) from accept,answer where answer.aid = accept.aid and answer.uid = $uid ";
		$result=mysql_query($query);
		if($row=mysql_fetch_array($result))
			return $row[0];
		else
			return 'fail';
	}


	function query_bonusdate_by_uid($uid){
		$dates = array();
		$index = 0;
		connect();
		//1
		$query="select time from upvote_question where uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//2
		$query="select time from downvote_question where uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//3
		$query="select time from upvote_answer where uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//4
		$query="select time from downvote_answer where uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//5
		$query="select time from question where uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//6
		$query="select time from answer where uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//7
		$query="select time from improvement where uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//8
		$query="select upvote_question.time from upvote_question,question where upvote_question.qid=question.qid and question.uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//9
		$query="select downvote_question.time from downvote_question,question where downvote_question.qid=question.qid and question.uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//10
		$query="select star.time from star,question where star.qid=question.qid and question.uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//11
		$query="select upvote_answer.time from upvote_answer,answer where upvote_answer.aid=answer.aid and answer.uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//12
		$query="select downvote_answer.time from downvote_answer,answer where downvote_answer.aid=answer.aid and answer.uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//13
		$query="select accept.time from accept,question where accept.qid=question.qid and question.uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		//14
		$query="select accept.time from accept,answer where accept.aid=answer.aid and answer.uid=$uid";
		$result=mysql_query($query);
		extract_date($result, $dates, $index);
		return $dates;
	}
	function extract_date($result, &$dates, &$index){
		while($row=mysql_fetch_assoc($result)){
			$date = substr($row['time'],0,10);
			if(!in_array($date, $dates))
				$dates[$index++]=$date;
		}
	}

	//Record query
	//1
	function query_time_upvote_question_by_date($uid,$date){
		connect();
		$query="select time from upvote_question where uid=$uid and time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//2
	function query_time_downvote_question_by_date($uid,$date){
		connect();
		$query="select time from downvote_question where uid=$uid and time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//3
	function query_time_upvote_answer_by_date($uid,$date){
		connect();
		$query="select time from upvote_answer where uid=$uid and time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//4
	function query_time_downvote_answer_by_date($uid,$date){
		connect();
		$query="select time from downvote_answer where uid=$uid and time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//5
	function query_time_question_by_date($uid,$date){
		connect();
		$query="select time from question where uid=$uid and time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//6
	function query_time_answer_by_date($uid,$date){
		connect();
		$query="select time from answer where uid=$uid and time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//7
	function query_time_improvement_by_date($uid,$date){
		connect();
		$query="select time from improvement where uid=$uid and time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//8
	function query_time_starred_by_date($uid,$date){
		connect();
		$query="select star.time from star,question where star.qid=question.qid and question.uid=$uid and star.time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//9
	function query_time_upvoted_question_by_date($uid,$date){
		connect();
		$query="select upvote_question.time from upvote_question,question where upvote_question.qid=question.qid and question.uid=$uid and upvote_question.time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//10
	function query_time_downvoted_question_by_date($uid,$date){
		connect();
		$query="select downvote_question.time from downvote_question,question where downvote_question.qid=question.qid and question.uid=$uid and downvote_question.time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//11
	function query_time_upvoted_answer_by_date($uid,$date){
		connect();
		$query="select upvote_answer.time from upvote_answer,answer where upvote_answer.aid=answer.aid and answer.uid=$uid and upvote_answer.time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//12
	function query_time_downvoted_answer_by_date($uid,$date){
		connect();
		$query="select downvote_answer.time from downvote_answer,answer where downvote_answer.aid=answer.aid and answer.uid=$uid and downvote_answer.time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//3
	function query_time_accept_by_date($uid,$date){
		connect();
		$query="select accept.time from accept,question where accept.qid=question.qid and question.uid=$uid and accept.time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
	//3
	function query_time_accepted_by_date($uid,$date){
		connect();
		$query="select accept.time from accept,answer where accept.aid=answer.aid and answer.uid=$uid and accept.time like '$date%'";
		$result = mysql_query($query);
		$a = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$a[$i++]=$row['time'];
		return $a;
	}
?>