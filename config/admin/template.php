<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2020 南京RXThinkCMF研发中心
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <1175401194@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 模板设置
// +----------------------------------------------------------------------

return [
    // 是否开启模板编译缓存,设为false则每次都会重新编译
    'tpl_cache'          => false,
    // 布局模板开关
    'layout_on'          => true,
    // 布局模板入口文件
    'layout_name'        => 'public/layout',
    // 布局模板的内容替换标识
    'layout_item'        => '{__CONTENT__}',
    // 视图输出字符串内容替换
    'tpl_replace_string' => [
        '__STATIC__'    => '/static',
        '__ADMIN__'     => '/static/admin',
        '__JS__'        => '/static/admin/js',
        '__CSS__'       => '/static/admin/css',
        '__IMAGES__'    => '/static/admin/images',
    ],
];
