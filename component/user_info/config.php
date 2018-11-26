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
        'title'   => '发送邮件',
        'type'    => 'radio',
        'options' => [
            '1' => '发送',
            '0' => '不发送'
        ],
        'value'   => '0',
        'tip'     => '是否用户提交信息, 发送邮件给管理员邮箱'
    ],
];