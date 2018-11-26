<?php
/**
 * Created by PhpStorm.
 * User: flnet
 * Date: 2018/11/26
 * Time: 14:05
 */
return [
    // 是否用户提交信息, 发送邮件给管理员邮箱

    'info_is_send_email' => [
        'title'   => '发送邮件<b style="color: #ff0000"></b>',
        'type'    => 'radio',
        'options' => [
            '1' => '发送',
            '0' => '不发送'
        ],
        'value'   => '0',
        'tip'     => '是否用户提交信息, 发送邮件给管理员邮箱'
    ],
    'type' => [
        'title' => '验证码类型',
        'type' => 'select',
        'options' => [
            '0' => '数字',
            '1' => '字母',
            '2' => '数字+字母',
            '3' => '中文'
        ],
        'value' => '2',
    ],
    'imageW' => [
        'title' => '图片宽度',
        'type' => 'text',
        'value' => '',
        'tip' => '图片宽度 单位 px（留空使用默认，优先取前台传值）'
    ],
    'imageH' => [
        'title' => '图片高度',
        'type' => 'text',
        'value' => '',
        'tip' => '图片高度 单位 px（留空使用默认，优先取前台传值）'
    ],
    'length' => [
        'title' => '验证码位数：',
        'type' => 'number',
        'value' => '4',
        'tip' => '最小设置为3，小于3不生效'
    ],
    'useCurve' => [
        'title' => '混淆曲线',
        'type' => 'radio',
        'options' => [
            '0' => '否',
            '1' => '是',
        ],
        'value' => '1',
    ],
    'useNoise' => [
        'title' => '噪点',
        'type' => 'radio',
        'options' => [
            '0' => '否',
            '1' => '是',
        ],
        'value' => '1',
    ],

    'reset' => [
        'title' => '验证成功后是否重置',
        'type' => 'radio',
        'options' => [
            '0' => '否',
            '1' => '是',
        ],
        'value' => '1',
    ],
    'bg' => [
        'title' => '背景色',
        'type' => 'text',
        'value' => '255,255,255',
        'tip' => '图片背景 例如 白色:255,255,255  黑色:0,0,0 红色:255,0,0'
    ],

];