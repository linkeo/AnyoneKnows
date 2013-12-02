<?php
	require('mysql.php');
	header('Content-Type: text/html; charset=UTF-8');
	function common_head(){
		?>
		<meta charset="utf-8">
		<script language="javascript" src="\jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="css/gh-buttons.css" >
		<link rel="stylesheet" type="text/css" href="css/homepage.css" >
		<script type="text/javascript" src="./ueditor/ueditor.parse.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#logoutbutton').attr('href',$('#logoutbutton').attr('href')+"?url="+window.location.href);
				$('#loginbutton').attr('href',$('#loginbutton').attr('href')+"?url="+window.location.href);
				$('.sitename').click(function(event) {
					location = '/';
				});
			});
	    	function doUParse(){
	       		uParse('.content',{
		            'highlightJsUrl':'./ueditor/third-party/SyntaxHighlighter/shCore.js',
		            'highlightCssUrl':'./ueditor/third-party/SyntaxHighlighter/shCoreDefault.css'
		        });
		    }
		</script>
		<?php
	}
	function common_nav(){
		$user = 0;
		if(is_logged())
			$user = query_user_by_uid($_COOKIE['uid']);
		?>
		<div id="navibar" class='container clearfix'>
			
			<div id='usernav' uid= <?php echo "'".$user['uid']."'"; ?> >
				<?php if(is_logged()){ ?>
				<div id='userinfo'>
					<a id='avator' href=<?php echo "user.php?uid=".$user['uid']; ?>><img class="avator" src=<?php echo "'".get_avator($user)."'"; ?>></a>
					<div id="loggeduser" class="username"><?php echo $user['name']; ?></div>
					<a class='button danger' id='logoutbutton' href='logout.php'>注销</a>
					</form>
				</div>
				<?php }else{ ?>
				<div class='button-group'>
					<a class='button primary' id='loginbutton' href='login.php'>登陆</a>
					<a class='button' href='register.php'>注册</a>
				</div>
				<?php } ?>
			</div>
			<div id='navigroup' class='button-group'>
				<a class='button' href='search.php'>问题</a>
				<a class='button' href='tags.php'>标签</a>
				<a class='button' href='users.php'>用户</a>
				<a class='button primary' href='new.php'>提问</a>
			</div>
			<form id="search" action='search.php' method='get'>
				<input type="text" class='textinput' placeholder="搜索" name='keyword'/>
			</form>
		</div>
		<?php
	}
	function common_footer(){
		?>
		<footer>@2013 AnyoneKnows by Linkeo</footer>
		<?php
	}
	function is_logged(){
		return (isset($_COOKIE['login'])&&$_COOKIE['login']==true);
	}
	function editor_require(){
		?>
		<script type="text/javascript" charset="utf-8">
		    window.UEDITOR_HOME_URL = "/ueditor/";  //UEDITOR_HOME_URL、config、all这三个顺序不能改变
		</script>
		<script type="text/javascript" src="./ueditor/ueditor.config.js"></script>
		<script type="text/javascript" src="./ueditor/ueditor.all.js"></script>
		<?php
	}
	function editor_display(){
		?>
	    <script type="text/javascript">
		    doUParse();
	    </script>
		<?php
	}
	/**  
	 * 发送post请求  
	 * @param string $url 请求地址  
	 * @param array $post_data post键值对数据  
	 * @return string  
	 */  
	function send_post($url, $post_data) {   
	  
	  $postdata = http_build_query($post_data);   
	  $options = array(   
	    'http' => array(   
	      'method' => 'POST',   
	      'header' => 'Content-type:application/x-www-form-urlencoded',   
	      'content' => $postdata,   
	      'timeout' => 15 * 60 // 超时时间（单位:s）   
	    )   
	  );   
	  $context = stream_context_create($options);   
	  $result = file_get_contents($url, false, $context);   
	  
	  return $result;   
	}
	function parse_tag_array($value){
		$result;
		preg_match_all("/\[[^\]]+\]/", $value, $result);
		return $result;
	}
	function get_avator($user){
		$index = $user['avator'];
		if($index>0&&$index<=64){
			return "image/avator/$index.jpg";
		}else{
			$gender = $user['gender'];
			if($gender==1)
				return "image/avator/0m.jpg";
			else if($gender==2)
				return "image/avator/0f.jpg";
			else
				return "image/avator/0.jpg";
		}
	}
	function get_avator_by_index($index, $gender){
		if($index>0&&$index<=64){
			return "image/avator/$index.jpg";
		}else{
			if($gender==1)
				return "image/avator/0m.jpg";
			else if($gender==2)
				return "image/avator/0f.jpg";
			else
				return "image/avator/0.jpg";
		}
	}
?>