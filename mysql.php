<?php

	$db_host='localhost';
	$db_user='root';
	$db_password='141592653';
	$db_schema='anyoneknows';
	$connect;

	function connect(){
		if(!$connect){
			$connect=mysql_connect($db_host,$db_user,$db_password);
			mysql_select_db($db_schema);
		}
	}

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
		$query="select username, password from user where username = '$username' and password = '$password'";
		$result=mysql_query($query);
		$user=mysql_fetch_assoc($result);
		mysql_free_result($query);
		if($user)
			return $user;
		else
			return 'password';
	}

	function query_user_by_uid($uid){
		connect();
		$query="select * from user where uid=$uid";
		$result=mysql_query($query);
		$user=mysql_fetch_assoc($result);
		mysql_free_result($query);
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
		mysql_free_result($query);
		if($user)
			return $user;
		else
			return false;
	}

	function insert_question($uid, $title, $content){
		connect();
		$query="insert into question(uid, title, content) values ($uid,'$title','$content')";
		if(mysql_query($query))
			return true;
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
		$query="insert into answer(uid, aid, content) values ($uid, $aid,'$content')";
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
		mysql_free_result($query);
		if($question)
			return $question;
		else
			return false;
	}

	function query_answers_by_qid($qid){
		connect();
		$query="select * from answer where qid=$qid";
		$result = mysql_query($query);
		$answers = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$answers[$i++];
		return $answers;
	}

	function query_improvements_by_aid($aid){
		connect();
		$query="select * from improvement where aid=$aid";
		$result = mysql_query($query);
		$improvs = array();
		$i=0;
		while($row=mysql_fetch_assoc($result))
			$improvs[$i++];
		return $improvs;
	}

?>