/**
 * 表单提交类
 * Copyright (c) 2016 phachon@163.com
 */
var Form = {

	failedBox : '#failedBox',

	inPopup : false,

	ajaxSubmit: function (element, inPopup) {
		
		if(inPopup) {
			Form.inPopup = true;
		}

		//成功弹出信息
		function success(messages, data) {
			
			$(Form.failedBox).html('');
			$(Form.failedBox).hide();
			var text = messages.join("\n");
			var timer = 2000;
			swal({
				'title' : '操作成功',
				'text' : "<h4>"+text+"</h4>",
				'html' : true,
				'type' : 'success',
				'showConfirmButton' : false,
				'timer' : timer,
				'location' : null
			});
		}

		//错误弹出信息
		function error(errors, data) {
			var text = errors.join("\n");
			var timer = 2000;
			swal({
				'title' : '操作失败',
				'text' : "<h4>"+text+"</h4>",
				'html' : true,
				'type' : 'error',
				'showConfirmButton' : false,
				'timer' : timer
			});
		}

		//警告弹出信息
		function warning(warnings, data) {
			var text = warnings.join("\n");
			var timer = 2000;
			swal({
				'title' : '警告',
				'text' : "<h4>"+text+"</h4>",
				'html' : true,
				'type' : 'warning',
				'showConfirmButton' : false,
				'timer' : timer
			});
		}

		//失败信息条
		function failed(messages, data) {
			// var text =  messages.join("\n").split(' ');
			var text =  messages;

			$(Form.failedBox).html('');
			$(Form.failedBox).removeClass('hide');
			$(Form.failedBox).addClass('alert alert-danger');
			$(Form.failedBox).append('<a class="close" href="#" onclick="$(this).parent().hide();">×</a>');
			$(Form.failedBox).append('<strong style="margin-top:0px;">操作失败！ </strong>');
			var ul = $('<ul></ul>');
			for(var i = 0; i < text.length; i++) {
				ul.append('<li>'+ text[i] +'</li>');
			}
			$(Form.failedBox).append(ul);
			$(Form.failedBox).show();
		}

		//弹出信息
		function response(result) {
			if(result.code == 0) {
				failed(result.messages, result.data);
			}
			if(result.code == 1) {
				success(result.messages, result.data);
			}
			if(result.code == 2) {
				failed(result.messages, result.data);
			}

			// if(Form.inPopup) {
			// 	setTimeout(function() { 
			// 		parent.$.layer.close();
			// 	}, 10);
			// }
			//如果设置了跳转
			if(result.redirect) {
				setTimeout(function() {
					if(Form.inPopup) {
						parent.location.href = result.redirect;
					} else {
						location.href = result.redirect;
					}
				}, 3000);
				//重新刷新
				setTimeout(function() {
					if(Form.inPopup) {
						parent.location.reload();
					} else {
						location.reload();
					}
				}, 3000);
			}
		}

		var options = {
			dataType: 'json',
			success: response
		};

		$(element).ajaxSubmit(options);

		return false;
	}
}