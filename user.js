$(document).ready(function() {
	$('#questions').click(function(event) {
		var data = {
			uid:$('#user').attr('uid'),
			list:'questions'
		}
		$.post('userFunctions.php', data, function(data, textStatus, xhr) {
			$('#questions').addClass('active');
			$('#answers').removeClass('active');
			$('#bonus').removeClass('active');
			$('#star').removeClass('active');
			$('#list').html(data);
		});
	});
	$('#answers').click(function(event) {
		var data = {
			uid:$('#user').attr('uid'),
			list:'answers'
		}
		$.post('userFunctions.php', data, function(data, textStatus, xhr) {
			$('#questions').removeClass('active');
			$('#answers').addClass('active');
			$('#bonus').removeClass('active');
			$('#star').removeClass('active');
			$('#list').html(data);
			doUParse();
		});
	});
	$('#bonus').click(function(event) {
		var data = {
			uid:$('#user').attr('uid'),
			list:'bonus'
		}
		$.post('userFunctions.php', data, function(data, textStatus, xhr) {
			$('#questions').removeClass('active');
			$('#answers').removeClass('active');
			$('#bonus').addClass('active');
			$('#star').removeClass('active');
			$('#list').html(data);
		});
	});
	$('#star').click(function(event) {
		var data = {
			uid:$('#user').attr('uid'),
			list:'star'
		}
		$.post('userFunctions.php', data, function(data, textStatus, xhr) {
			$('#questions').removeClass('active');
			$('#answers').removeClass('active');
			$('#bonus').removeClass('active');
			$('#star').addClass('active');
			$('#list').html(data);
		});
	});
	$('#bonus').click();
});