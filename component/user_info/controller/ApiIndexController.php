<?php
/**
 * Created by PhpStorm.
 * User: flnet
 * Date: 2018/11/26
 * Time: 8:22
 */

namespace plugins\user_info\controller;

use cmf\controller\PluginRestBaseController;
use plugins\user_info\model\PluginUserInfoModel;
use plugins\user_info\validate\UserInfoVaildate;

class ApiIndexController extends PluginRestBaseController {

    public function index() {
        $this->success('success',['hello'=>'hello world!']);
    }

    /**
     * 提交用户信息
     *
     * {
     *    "name": "cary",
     *    "company": "foxconn",
     *    "phone": "13620956842",
     *    "site": "Gongdong",
     *    "description": "caryinfo"
     * }
     */
    public function submitMessage() {
        $result = [
            'code' => -1,
            'msg'  => '无效的请求',
            'data' => '',
        ];
        if ($this->request->isPost()){
            $par = ['name', 'company', 'phone', 'email', 'site', 'description'];
            $resdata = $this->request->only($par);
            $validate = new UserInfoVaildate();
            $vacheck = $validate->check($resdata);
            if ($vacheck){
                $resdata['ip'] =  $ip = get_client_ip();
                $res = PluginUserInfoModel::create($resdata);
                if ($res) {
                    $config = $this->getPlugin()->getConfig();
                    if($config['info_is_send_email'] == '1'){
                        $sendemail = cmf_get_option('smtp_setting');
                        if($sendemail && $sendemail['from']){
                            $strhtml = '<table border="1" cellpadding="6" cellspacing="0"><caption>用户信息</caption>
                                <tr><th align="right">Name</th><td >'.isset($res['name'])|''.'</td></tr>
                                <tr><th align="right">Company</th><td >'.isset($res['company'])|''.'</td></tr>
                                <tr><th align="right">Email</th><td >'.isset($res['email'])|''.'</td></tr>
                                <tr><th align="right">Phone</th><td >'.isset($res['phone'])|''.'</td></tr>
                                <tr><th align="right">Site</th><td >'.isset($res['site'])|''.'</td></tr>
                                <tr><th align="right">Description</th><td >'.isset($res['description'])|''.'</td></tr></table>';
                            cmf_send_email($sendemail['from'], cmf_get_site_info()['site_name'], $strhtml);
                        }
                    }
                    $this->success('信息提交成功', $res);
                }
                $result['msg'] = '添加数据失败, 请重试!';
                $this->error($result);
            }else{
                $result['msg'] = $validate->getError();
                $this->error($result);
            }
        }
        $this->error($result);
    }

    // 测试用的
    public function test() {
        $config = $this->getPlugin()->getConfig();
        $sendemail = cmf_get_option('smtp_setting')['from']; //['acceepter'];
        $ip = get_client_ip();
        $this->success('获取配置', $ip);
    }

}