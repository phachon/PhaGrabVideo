/**
 * video
 * Created by phachon@163.com
 */
var Video = {

    /**
     * 抓取
     */
    grab: {

        /**
         * 来源
         */
        source: function (element) {
            var data = $(element).attr('data');
            $('a[name="source"]').removeClass('active');
            $(element).addClass('active');
            $('input[name="source"]').val(data);
        },

        /**
         * 提交
         */
        submit: function (form) {
            // alert('ok');
            var type = 0;
            $('input[name="grab_type"]').each(function () {
                if(this.checked == true) {
                    type = this.value;
                }
            });
            if(type == 0) {
                form.submit();
            } else {
                Form.ajaxSubmit(form, 'false');
            }
        }
    }
};