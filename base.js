$(document).ready(function() {
	//обработка ajax
	$('.jsSubmit').on('click', function(e){
		e.preventDefault();
		$.get($(this).attr('href'), function(data){
			if(data.result == "add"){
				$('.jsUsersBlock p').last().after(data.message);
				$('.jsSubmit').html("Уже не нравится");
			}
			else if(data.result == "del"){
				$('.jsUsersBlock p.jsDel').remove();
				$('.jsSubmit').html("Мне нравится статья");
			}
		}, "json");
	});
	
});