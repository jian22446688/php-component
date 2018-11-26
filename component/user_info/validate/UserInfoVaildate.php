<?php
/**
 * Created by PhpStorm.
 * User: flnet
 * Date: 2018/11/26
 * Time: 11:30
 */

namespace plugins\user_info\validate;

use think\Validate;

class UserInfoVaildate extends Validate {


    //* {
    //*    "name": "cary",
    //*    "company": "foxconn",
    //*    "phone": "13620956842",
    //*    "site": "Gongdong",
    //*    "description": "caryinfo"
    //* }

    protected $rule = [
        'name'      => 'require|max:24',
        'phone'     => 'number|length:11',
        'email'     => 'require|email',
        'site'      => 'require'
    ];

    protected $message = [
        'name.require'  => '名称不能为空!',
        'name.max'      => '名称最大不能超过24个字符!',
        'phone.number'  => '手机号必须为数字形式!',
        'phone.length'  => '请填写11位长度的正确手机号!',
        'email'         => '请填写正确的邮箱地址',
        'site.require'  => '城市不能为空!'
    ];
}