/**
 * Created by phachon@163.com
 */
var Url = {

    /**
     * 添加
     */
    add: {
        /**
         * 来源
         */
        source: function (element) {
            var data = $(element).attr('data');
            $('a[name="source"]').removeClass('active');
            $(element).addClass('active');
            $('input[name="website_id"]').val(data);
        }
    }
};