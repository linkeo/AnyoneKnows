<!doctype html>
<html>
<head>
	<?php require('model.php');
		common_head();
		if(!is_logged())
			header("Location: login.php");
		editor_require();
	 ?>
	<title>发表新帖</title>
	<script type="text/javascript">
	$(document).ready(function() {
		var form = $('#form');
		var title = $('#newtitle');
		var tags = $('#newtags');
		title.blur(validateT);
		title.keyup(validateT);
		tags.blur(validateTags);
		tags.keyup(validateTags);

		//On Submitting
		form.submit(function(){
			if(validateT() && validateC() && validateTags())
				return true;
			else
				return false;
		});
	});
	function validateT(){
		var input = $('#newtitle');
		var title = input.val();
		if(title.length<1){
			input.addClass('error');
			return false;
		}else if (title.length>128) {
			input.addClass('error');
			return false;
		}else{
			input.removeClass('error');
			return true;
		}
	}
	function validateTags(){
		var input = $('#newtags');
		var tags = input.val();
		var filter = /^( *\w+ *(, *\w+ *)*)?$/;
		if(!filter.test(tags)){
			input.addClass('error');
			return false;
		}else{
			input.removeClass('error');
			return true;
		}
	}
	function validateC(){
		var input = $('#newcontent');
		var content = input.val();
		if(content.length<1){
			input.addClass('error');
			return false;
		}else if (content.length>65535) {
			input.addClass('error');
			return false;
		}else{
			input.removeClass('error');
			return true;
		}
	}
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
			<h2 class='title'>发表新帖
			</h2>
			<br>
			<form action='preview.php' method='post' id='form'>
				<label for='newtitle' id='newtitlelabel'><span class='sitename'>有谁<b>知道</b></span>:</label>
				<input type='text' class='textinput' id='newtitle' name='newtitle' placeholder='这里填写问题标题'>
				<br>
				<label for='newtags' id='newtagslabel'>相关标签:</label>
				<input type='text' class='textinput' id='newtags' name='newtags' placeholder='这里填写标签,以逗号隔开,如:java, Swing'>
				<script type='text/plain' name="newcontent" id="myEditor" ></script>
				<script type="text/javascript">
				    UE.getEditor('myEditor')
				</script>
				<br>
				<input id='newquestion' type='submit' name='send' value='提交问题' class='button primary'>
			</form>
		</div>
	</div>

	<?php common_footer(); ?>
</body>
</html>