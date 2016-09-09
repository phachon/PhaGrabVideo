/**
 * main
 * Copyright (c) 2016 phachon@163.com
 */

/**
 * 调整工作区尺寸
 */
function resizeContentHeight() {
    var mainHeight = document.body.clientHeight - 40;
    $('#menuFrame').height(mainHeight);
}

$(window).resize(function() {
    resizeContentHeight();
});

/**
 * 加载菜单
 */
function loadMenus() {
    var menuBox = $('#MenuBox');
    menuBox.find('[data-navigator]').hide();

    for (var i = 0; i < privileges.length; i++) {
        menuBox.find('[data-navigator="'+ privileges[i] +'"]').show();
    }
}

$(window).load(function() {
    resizeContentHeight();
    //loadMenus();

    $('#MenuBox > li > a').click(function() {
        var li = $(this).parent('li');
        var lis = li.siblings();
        var ul = lis.children();
        li.addClass('active');
        li.removeClass('active');
        ul.removeClass('in');
    });

    $('#MenuBox > li > ul > li > a').click(function() {
        var li = $(this).parent('li');
        var ul = li.parent('ul');
        var firestLi = ul.parent('li').find('a:first');
        var name = li.text().trim();
        var pname = firestLi.text().trim();

        $('#MenuBox > li > ul > li').removeClass('active');
        li.addClass('active');

        $('.route_bg').find('a:first').text(pname);
        $('.route_bg').find('a:last').text(name);
    });

});
// <li data-navigator='account' style="display: none">
//     <a href="javascript:;" data-toggle="collapse" data-target="#account"><span
// class="glyphicon glyphicon-user"> 账号管理 </span></a>
//     <ul id="account" class="collapse">
//     <li>
//     <a href="<?php echo URL::site('account/add');?>" target="menuFrame"><span
// class="glyphicon glyphicon-list"></span><span class="text"> 添加账号 </span></a>
//     </li>
//     <li>
//     <a href="<?php echo URL::site('account/list');?>" target="menuFrame"><span
// class="glyphicon glyphicon-list"></span><span class="text"> 账号列表 </span></a>
//     </li>
//     </ul>
//     </li>