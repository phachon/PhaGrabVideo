/**
 * iframe弹出框类,依赖 jQuery.layer.js 插件
 * Copyright (c) 2016 phachon@163.com
 */
var Popup = {

	/**
	 * 类型
	 */
	type : 2,

	/**
	 * 皮肤
	 */
	skin : 'layui-layer-lan',

	/**
	 * iframe框标题
	 */
	title : ' ',

	/**
	 * 是否显示关闭按钮
	 */
	shadeClose : true,

	/**
	 * 遮罩层的深浅度
	 */
	shade : 0.6,

	/**
	 * 是否显示最大化最小化按钮
	 */
	maxmin : true,

	/**
	 * 框大小
	 */
	area :['1000px', '500px'],
	
	/**
	 * 内容或者url
	 */
	content : '',

	/**
	 * element
	 */
	element : '',

	setTitle : function (title) {
		this.title = title;
		return this;
	},

	setContent : function (content) {
		this.content = content;
		return this;
	},

	/**
	 * 绑定为 iframe 层
	 * @param  String element
	 * @param  String title
	 * @param  String content
	 * @return String 
	 */
	bindIframe : function (element, title, content) {
		
		//Popup.setTitle(title);
		Popup.setContent(content);
		Popup.element = element;

		Popup.execute(title);
		
	},

	/**
	 * 绑定为 iframe 框
	 * @param  String element
	 * @param  String title
	 * @param  String content
	 * @return String 
	 */
	bindIframeWinow : function (element, title, content) {
		
		Popup.shade = [0];
		Popup.bindIframe(element, title, content);
		
	},

	/**
	 * 执行
	 */
	execute : function (title) {

		$(Popup.element).each(function() {

			$(this).click(function() {
				if(Popup.content == null) {
					if($(this).attr('data-link')) {
						Popup.content = $(this).attr('data-link');
					}
				} else {
					Popup.content = ' ';
				}
				layer.open({
					type: Popup.type,
					skin: Popup.skin,
					title: title,
					shadeClose: Popup.shadeClose,
					shade: Popup.shade,
					maxmin: Popup.maxmin,
					area: Popup.area,
					content: Popup.content,
				});
				Popup.content = null;
			});
		});
	}
}