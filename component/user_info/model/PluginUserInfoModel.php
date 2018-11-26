<?php
/**
 * Created by PhpStorm.
 * User: flnet
 * Date: 2018/11/23
 * Time: 15:24
 */

namespace plugins\user_info\model;


use think\Model;
use traits\model\SoftDelete;

class PluginUserInfoModel extends Model {

    protected $autoWriteTimestamp = 'datetime';
    // 时间字段取出后的默认时间格式
    protected $dateFormat = 'Y-m-d';

    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public function test() {
        
    }
}