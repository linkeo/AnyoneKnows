$(document).ready(function() {
	$('#avator-show').click(function(event) {
		$('.avator.selection').each(function(index, el) {
			if($(this).attr('value')==$('#avator-input').val())
				$(this).addClass('active');
			else
				$(this).removeClass('active');
		});
		$('#avator-panel').fadeIn('fast');
	});
	$('#avator-panel').click(function(event) {
		$('#avator-panel').fadeOut('fast');
	});
	$('.avator.selection').each(function(index, el) {
		$(this).click(function(event) {
			$('#avator-input').val($(this).attr('value'));
			$('#avator-show').attr('src',$(this).attr('src'));
		});
	});
	$("#edit-form").submit(function(event) {
		var name = $('#name').val();
		if(name.length<=0){
			alert('请填写昵称, 昵称不能为空!');
			return false;
		}else if(name.length>64){
			alert('昵称填写过长, 请删除第64个字符以后的部分!');
			return false;
		}else if($('#website').val().length>128){
			alert('网址填写过长, 请删除第128个字符以后的部分!');
			return false;
		}else if($('#location').val().length>128){
			alert('地址填写过长, 请删除第128个字符以后的部分!');
			return false;
		}else
			return true;
	});
});