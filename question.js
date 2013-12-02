$(document).ready(function() {
	$('#reply').hide();
	//delete a question
	$('#delete').click(function(){
		if(confirm('你确定删除此问题?')){
			deleteQuestion($('#question').attr('qid'));
		}
	});
	$('.delete.answer').each(function(index, el){
		$(this).click(function(){
			if(confirm('你确定删除此回答?')){
				deleteAnswer($(this).closest('.aitem').attr('aid'));
			}
		})
	});
	$('.delete.improv').each(function(index, el){
		$(this).click(function(){
			if(confirm('你确定删除此补充回答?')){
				deleteImprovement($(this).closest('.improvement').attr('iid'));
			}
		})
	});
	//accept an answer
	$('.accept.answer').each(function(index, el){
		$(this).click(function(){
			if(confirm('你确定采用此回答?')){
				acceptAnswer($('#question').attr('qid'),$(this).closest('.aitem').attr('aid'));
			}
		})
	});
	//reply a question
	$('#answer').click(function(){
		var uid=$('#usernav').attr('uid');
		if(uid==0){
			alert("请先登录再发言!");
			return;
		}
		$('#reply').show();
		$('#replylabel').html("<h3>你的回答</h3>");
		$('#replyid').val($('#question').attr('qid'));
		var editor=UE.getEditor('myEditor');
		$('#replyform').submit(function(event) {
			event.preventDefault();
			submitAnswer();
			$('#reply').hide();
		});
		$(document).scrollTop($('#reply').offset().top);
	});
	//reply an answer
	$('.stat.improv').each(function(index, el) {
		$(this).click(function(){
			var uid=$('#usernav').attr('uid');
			if(uid==0){
				alert("请先登录再发言!");
				return;
			}
			$('#reply').show();
			$('#replylabel').html("<h3>你的改进");
			$('#replyid').val($(this).closest('.aitem').attr('aid'));
			var editor=UE.getEditor('myEditor');
			$('#replyform').submit(function(event) {
				event.preventDefault();
				submitImprovement();
				$('#reply').hide();
			});
			$(document).scrollTop($('#reply').offset().top);
		});
	});
	//upvote a question
	$('.upvote.question').each(function(index, el) {
		$(this).click(function(){
			upvoteQuestion($('#question').attr('qid'),$(this));
		});
	});
	//downvote a question
	$('.downvote.question').each(function(index, el) {
		$(this).click(function(){
			downvoteQuestion($('#question').attr('qid'),$(this));
		});
	});
	//star a question
	$('.star.question').each(function(index, el) {
		$(this).click(function(){
			star($('#question').attr('qid'),$(this));
		});
	});
	//upvote a answer
	$('.upvote.answer').each(function(index, el) {
		$(this).click(function(){
			upvoteAnswer($(this).closest('.aitem').attr('aid'),$(this));
		});
	});
	//downvote a answer
	$('.downvote.answer').each(function(index, el) {
		$(this).click(function(){
			downvoteAnswer($(this).closest('.aitem').attr('aid'),$(this));
		});
	});
});
function submitAnswer(){
	var uid=$('#usernav').attr('uid');
	if(uid==0){
		alert("请先登录再发言!");
	}else{
		var editor=UE.getEditor('myEditor');
		editor.sync();
		var data={
			'uid':uid,
			'qid':$('#replyid').val(),
			'content':editor.getContent()
		};
		$.post('submitAnswer.php', data, function(data, textStatus, xhr) {
			if(data=='success'){
				alert('回答成功!');
				location.reload();
			}else{
				alert('回答失败:'+data);
			}
		});
	}
}
function submitImprovement(){
	var uid=$('#usernav').attr('uid');
	if(uid==0){
		alert("请先登录再发言!");
	}else{
		var editor=UE.getEditor('myEditor');
		editor.sync();
		var data={
			'uid':uid,
			'aid':$('#replyid').val(),
			'content':editor.getContent()
		};
		$.post('submitImprovement.php', data, function(data, textStatus, xhr) {
			if(data=='success'){
				alert('补充成功!');
				location.reload();
			}else{
				alert('补充失败:'+data);
			}
		});
	}
}
function upvoteQuestion(qid,button){
	vote('upvote','question',qid,button);
}
function downvoteQuestion(qid,button){
	vote('downvote','question',qid,button);
}
function upvoteAnswer(aid,button){
	vote('upvote','answer',aid,button);
}
function downvoteAnswer(aid,button){
	vote('downvote','answer',aid,button);
}
function star(qid,button){
	vote('star','question',qid,button);
}
function vote(action,target,id,button){
	var uid=$('#usernav').attr('uid');
	if(uid==0){
		alert("请先登录再操作!");
	}else{
		var data={
			'uid':uid,
			'action':action,
			'target':target,
			'id':id
		};
		$.post('vote.php', data, function(data, textStatus, xhr) {
			var actionstr='';
			switch(action){
				case 'upvote':actionstr='点赞'; break;
				case 'downvote':actionstr='点贬'; break;
				case 'star':actionstr='收藏'; break;
			}
			if(!(/^(no action|error|fail|forbid|self)$/.test(data))){
				button.html(data);
			}else{
				var result = '';
				var oppo = '';
				if(action=='upvote')
					oppo = '点贬';
				else if(action=='downvote')
					oppo = '点赞';
				var targetstr= '';
				if(target=='question')
					targetstr='问题';
				else if(target=='answer')
					targetstr='回答';

				switch(data){
				case 'no action':result='设置行为失败, 持续出现请联系管理员.'; break;
				case 'error':result='设置行为错误, 持续出现请联系管理员.'; break;
				case 'fail':result='请稍后再试.'; break;
				case 'forbid':result='您已'+oppo+',请先取消'+oppo+'再'+actionstr; break;
				case 'self':result='您不能对自己的'+targetstr+actionstr; break;
				}
				alert(actionstr + '失败: '+result);
			}
		});
	}
}
function deleteQuestion(qid){
	deletee('question',qid,'search.php');
}
function deleteAnswer(aid){
	deletee('answer',aid,location.href);
}
function deleteImprovement(iid){
	deletee('improvement',iid,location.href);
}
function deletee(target,id,url){
	var uid=$('#usernav').attr('uid');
	var data={
		'uid':uid,
		'target':target,
		'id':id
	};
	$.post('delete.php', data, function(data, textStatus, xhr) {
		if(data=='success'){
			alert('删除成功!');
			location=url;
		}else{
			alert('删除失败:'+data);
		}
	});
}
function acceptAnswer(qid,aid){
	var uid=$('#usernav').attr('uid');
	var data={
		'uid':uid,
		'qid':qid,
		'aid':aid
	};
	$.post('accept.php', data, function(data, textStatus, xhr) {
		if(data=='success'){
			alert('采纳成功!');
			location.reload();
		}else{
			alert('采纳失败:'+data);
		}
	});
}