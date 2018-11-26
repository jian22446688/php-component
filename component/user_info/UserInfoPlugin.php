<?php
/**
 * Created by PhpStorm.
 * User: flnet
 * Date: 2018/11/23
 * Time: 14:38
 */

namespace plugins\user_info;

use cmf\lib\Plugin;
use think\Db;

class UserInfoPlugin extends Plugin {

    public $info = [
        'name'        => 'UserInfo', //Demo插件英文名，改成你的插件英文就行了
        'title'       => '用户信息资料',
        'description' => '用于收集用户提交资料',
        'status'      => 1,
        'author'      => 'Cary',
        'version'     => '1.0',
        'demo_url'    => 'http://demo.pyge.top',
        'author_url'  => 'http://www.pyge.top'
    ];

    public $hasAdmin = 1;//插件是否有后台管理界面

    public $types = ['123456789',
        'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghjkmnopqrstuvwxyz',
        '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghjkmnopqrstuvwxyz'
    ];

    public function install() {
        // TODO: Implement install() method.
        // 安装插件时初始化创建 数据库
        $dbConfig = config('database');
        $sql = cmf_split_sql( __DIR__ . '/user_info.sql', $dbConfig['prefix'], $dbConfig['charset'], 'dm_');
        foreach ($sql as $value) {
            try {
                Db::execute($value);
            } catch (\Exception $e) {}
        }
        return true;
    }

    public function uninstall() {
        return true;
    }

    // 加入 修改验证码
    public function captchaImage($param) {
        $captcha = $this->getConfig();
        if ($captcha['type'] == 3) {
            $codeSet = $this->types[2];
            $captcha['useZh'] = 1;
        } else {
            $codeSet = $this->types[$captcha['type']];
        }
        $captcha['codeSet'] = $codeSet;
        unset($captcha['type']);
        $bg = explode(',', $captcha['bg']);
        array_walk($bg, 'intval');
        if (count($bg) > 2 && $bg[0] < 256 && $bg[1] < 256 && $bg[2] < 256) {
            $captcha['bg'] = $bg;
        } else {
            $captcha['bg'] = '';
        }
        foreach ($captcha as $k => &$v) {
            //接收前台长宽
            if (in_array($k,['imageW','imageH'] )&&isset($param[$k]) && $param[$k] > 0) {
                $v = $param[$k];
            }
        }
        config('captcha', $captcha);
    }

}
