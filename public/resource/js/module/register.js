/**
 * 注册
 * Copyright (c) 2016 phachon@163.com
 */
var Register = {

	ajaxSubmit : function(element) {

		var name = $('input[name="name"]').val();
		var givenName = $('input[name="given_name"]').val();
		var email = $('input[name="email"]').val();
		var mobile = $('input[name="mobile"]').val();
		var password = $('input[name="password"]').val();
		var repass = $('input[name="repass"]').val();
		var captcha = $('input[name="captcha"]').val();
		if(name == '' || password == ''
		|| givenName == '' || email == ''
		|| mobile == '' || password == ''
		|| repass == '' || captcha == '') {
			return false;
		}

		if(password != repass) {
			failed('两次密码不一致');
			return false;
		}

		function success(messages, data) {
			$("#failedMessage").hide();
			$("#failedMessage label").html('');

			var text = messages.join("\n");
			var timer = 2000;
			swal({
				'title' : '注册成功',
				'text' : "<h4>"+text+"</h4>",
				'html' : true,
				'type' : 'success',
				'showConfirmButton' : false,
				'timer' : timer,
				'location' : null
			});
		}
		
		function failed(errors) {
			$("#failedMessage").show();
			$("#failedMessage label").html(errors);
		}

		function response(result) {

			if(result.code == 0) {
				failed(result.messages, result.data);
			}
			if(result.code == 1) {
				success(result.messages, result.data);
				if(result.redirect) {
					location.href = result.redirect;
					setTimeout(function() {
						location.reload(true);
					}, 2000);
				}
			}
		}

		var options = {
			dataType: 'json',
			success: response
		};

		$(element).ajaxSubmit(options);
	}
}