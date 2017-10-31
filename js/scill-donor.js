/*$(function() {
	$('#modal-1 form, #modal-2 form, #form-3').submit(function(e) {
		e.preventDefault();
		var formValid = true;
		$(this).find('input').each(function() {
			var formGroup = $(this).parents('.form-group');
			var glyphicon = formGroup.find('.form-control-feedback');
			if (this.checkValidity()) {
				formGroup.addClass('has-success').removeClass('has-error');
				glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
			} else {
				formGroup.addClass('has-error').removeClass('has-success');
				glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
				formValid = false;  
			}
		});
		if (formValid) {
			var email = $("#input-email, #input-email-1, #input-footer").val();
			var password = $("#input-password, #input-password-1,#input-password-3").val();
			var checkbox = $("#check-1,#check-2").val();

			var formData = new FormData();
			formData.append('email', email);
			formData.append('password', password);
			formData.append('checkbox',checkbox);

			$.ajax({
				type: "POST",
				url: "send.php",
				data: formData,
				contentType: false,
				processData: false,
				cashe: false,
				success : function(data){
					var $data = JSON.parse(data);
					$('#error').text('');
					if ($data.result == "success"){
						$('#modal-1 form, #modal-2 form').hide();
						$('#success-alert,#success-alert-1').removeClass('hidden')
					}else{
						$('#error,#error-1').text('There were errors while sending the form to the server.')
					} 
				},
				error: function (request) {
					$('#error,#error-1').text('An error has occurred ' + request.responseText + ' when sending data.');
				}     
			});
			$("#modal-1 form, #modal-2 form, #form-3").trigger('reset'), 3000;
		}
	});
});*/
$(document).ready(function () {
	$("form").submit(function (event) {
		event.preventDefault();
		var formId = $(this).attr('id');
		var formNm = $('#' + formId);
		var formValid = true;
		$(this).find('input').each(function() {
			var formGroup = $(this).parents('.form-group');
			var glyphicon = formGroup.find('.form-control-feedback');
			if (this.checkValidity()) {
				formGroup.addClass('has-success').removeClass('has-error');
				glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
			} else {
				formGroup.addClass('has-error').removeClass('has-success');
				glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
				formValid = false;  
			}
		});
		$.ajax({
			type: "POST",
			url: 'send.php',
			data: formNm.serialize(),
			success: function (data) {
				var $data =  JSON.parse(data);
				$("form")
				$('.error').text('');
				if ($data.result == "success") {
 			// скрываем форму обратной связи
 			$('form').hide();
			// удаляем у элемента, имеющего id=successMessage, класс hidden
			$('#successMessage').removeClass('hidden');
		}else {
            // если сервер вернул ответ error, то делаем следующее...
            $('error').text('There were errors while sending the form to the server.');
          }
          
        },
        error: function (error) {
        	
        	$('.error').text('An error has occurred  when sending data.');
        }     
      });
		setTimeout(function(){
			$(':input', 'form')
			.not(':button, :submit, :reset, :hidden')
			.val('')
			.removeAttr('checked');
		}, 3000);
	});
});