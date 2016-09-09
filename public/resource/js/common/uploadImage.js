/**
 * 上传图片类
 * Copyright (c) 2016 phachon@163.com
 */
var UploadImage = {

	/**
	 * element
	 */
	element : null,

	/**
	 * input[name="image_url"]
	 */
	imageUrl : '#image_url',

	/**
	 * 初始化
	 * @param element
	 * @param config
	 * @param imageUrl
     */
	init : function(element, config, imageUrl) {

		this.element = element;
		if(imageUrl) {
			this.imageUrl = imageUrl;
		}

		$(element).fileinput(config);
		this.fileUploaded();
		this.batchUploads();
		this.deleteBefore();
		this.deleteSuccess();
	},

	/**
	 * 单个上传
	 */
	fileUploaded : function() {
		$(this.element).on('fileuploaded', function(event, data) {
			if(data.response.code == 1) {
				$(UploadImage.imageUrl).val(data.response.data.url);
			} else {
				Common.errorAlert(data.response.messages);
			}
		});
	},

	/**
	 * 上传完成
	 */
	batchUploads : function() {
		$(this.element).on('filebatchuploadsuccess', function(event, data) {
			if(data.response.code == 1) {
				$(UploadImage.imageUrl).val(data.response.data.url);
			} else {
				Common.errorAlert(data.response.messages);
			}
		});
	},

	/**
	 * 删除前
	 */
	deleteBefore : function() {
		$(this.element).on('filepredelete', function(event, data) {

		});
	},

	/**
	 * 删除成功
	 */
	deleteSuccess : function() {
		$(this.element).on('filedeleted', function(event, data) {
			$(UploadImage.imageUrl).val('');
			Common.successAlert('删除图片成功');
		});
	}
}