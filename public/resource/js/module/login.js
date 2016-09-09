/**
 * 登录
 * Copyright (c) 2016 phachon@163.com
 */
var Login = {

	ajaxSubmit : function(element) {

		var name = $('input[name="name"]').val();
		var password = $('input[name="password"]').val();
		if(name == '' || password == '') {
			return false;
		}

		function success(messages, data) {
			var text = messages.join("\n");
			var timer = 2000;
			swal({
				'title' : '登陆成功',
				'text' : "<h4>"+text+"</h4>",
				'html' : true,
				'type' : 'success',
				'showConfirmButton' : false,
				'timer' : timer,
				'location' : null,
			});
		}

		function failed(errors, data) {
			var text = errors.join("\n");
			var timer = 2000;
			swal({
				'title' : '登陆失败',
				'text' : "<h4>"+text+"</h4>",
				'html' : true,
				'type' : 'error',
				'showConfirmButton' : false,
				'timer' : timer
			});
		}

		function response(result) {

			if(result.code == 0) {
				failed(result.messages, result.data);
			}
			if(result.code == 1) {
				//success(result.messages, result.data);
				if(result.redirect) {
					location.href = result.redirect;
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 2000);
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