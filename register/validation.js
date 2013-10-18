/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#customForm");
	var name = $("#name");
	var nameInfo = $("#nameInfo");
	var username = $("#username");
	var usernameInfo = $("#usernameInfo");
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	var pass1 = $("#pass1");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#pass2");
	var pass2Info = $("#pass2Info");
	var message = $("#message");
	
	//On blur
	username.blur(validateUsername);
	name.blur(validateName);
	email.blur(validateEmail);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	//On key press
	username.keyup(validateUsername);
	name.keyup(validateName);
	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	//On Submitting
	form.submit(function(){
		if(validateUsername() & validateName() & validateEmail() & validatePass1() & validatePass2())
			return true;
		else
			return false;
	});
	
	//validation functions
	function validateEmail(){
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(!filter.test(a)){
			email.addClass("error");
			emailInfo.text("请输入可用的E-mail, 这要用作激活您的账号!");
			emailInfo.addClass("error");
			return false;
		}
		else {
			$.post("/register/validation.php",{type:"username",username:username.val()}, function(data){
				if(data=='exist'){
					email.addClass("error");
					emailInfo.text("该E-mail已被使用!");
					emailInfo.addClass("error");
					return false;
				}
			});
			email.removeClass("error");
			emailInfo.text("√");
			emailInfo.removeClass("error");
			return true;
		}
	}
	function validateUsername(){
		//if it's NOT valid
		var filter = /^[a-z0-9]+$/;
		if(username.val().length >25){
			username.addClass("error");
			usernameInfo.text("用户名最多只能有25个字符!");
			usernameInfo.addClass("error");
			return false;
		}
		else if(username.val().length <6){
			username.addClass("error");
			usernameInfo.text("用户名最少要有6个字符!");
			usernameInfo.addClass("error");
			return false;
		}
		else if(!filter.test(username.val())){
			username.addClass("error");
			usernameInfo.text("用户名只能含有小写英文字母和数字!");
			usernameInfo.addClass("error");
			return false;
		}
		else {
			$.post("/register/validation.php",{type:"username",username:username.val()}, function(data){
				if(data=='exist'){
					username.addClass("error");
					usernameInfo.text("该用户名已被使用!");
					usernameInfo.addClass("error");
					return false;
				}
			});
			username.removeClass("error");
			usernameInfo.text("√");
			usernameInfo.removeClass("error");
			return true;
		}
	}
	function validateName(){
		//if it's NOT valid
		if(name.val().length >32){
			name.addClass("error");
			nameInfo.text("昵称最多只能有32个字符!");
			nameInfo.addClass("error");
			return false;
		}
		else if(name.val().length <1){
			name.addClass("error");
			nameInfo.text("请输入你的昵称!");
			nameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			name.removeClass("error");
			nameInfo.text("√");
			nameInfo.removeClass("error");
			return true;
		}
	}
	function validatePass1(){
		var a = $("#password1");
		var b = $("#password2");

		//it's NOT valid
		if(pass1.val().length <6){
			pass1.addClass("error");
			pass1Info.text("密码最少要有6个字符!");
			pass1Info.addClass("error");
			return false;
		}
		else if(pass1.val().length >25){
			pass1.addClass("error");
			pass1Info.text("用户名最多只能有25个字符!");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			pass1.removeClass("error");
			pass1Info.text("√");
			pass1Info.removeClass("error");
			validatePass2();
			return true;
		}
	}
	function validatePass2(){
		var a = $("#password1");
		var b = $("#password2");
		//are NOT valid
		if( pass1.val() != pass2.val() ){
			pass2.addClass("error");
			pass2Info.text("两次输入的密码不一致!");
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2.removeClass("error");
			pass2Info.text("√");
			pass2Info.removeClass("error");
			return true;
		}
	}
});