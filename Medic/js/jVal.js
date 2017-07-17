$(function(){
	$('#form').validate({
		rules: {
			name: {
				required: true,
				minlength: 2
			}
		},
		messages: {
			name: {
				required:      "Поле 'Имя' обязательно к заполнению",
				minlength:   "Введите не менее 2-х символов в поле 'Имя'"
                            }
			
		}
	});
});
	