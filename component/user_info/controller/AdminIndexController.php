<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\user_info\controller; //Demo插件英文名，改成你的插件英文就行了

use cmf\controller\PluginAdminBaseController;
use cmf\controller\PluginBaseController;
use plugins\user_info\model\PluginUserInfoModel;
use think\Loader;

class AdminIndexController extends PluginBaseController {
    public function _initialize() {
        $adminId = cmf_get_current_admin_id();//获取后台管理员id，可判断是否登录
        if (!empty($adminId)) {
            $this->assign("admin_id", $adminId);
        } else {
            $this->error('未登录');
        }
    }

    /**
     * 用户信息管理
     * @adminMenu(
     *     'name'   => '用户信息管理',
     *     'parent' => 'admin/Plugin/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户信息管理',
     *     'param'  => ''
     * )
     */
    public function index() {
        $userinfo = new PluginUserInfoModel();
        $pag = $userinfo->order('id', 'DESC')->paginate(20);
        $res = $userinfo->where('status', 0)->select();
        $this->assign('unreadcount', $res->count());
        $this->assign('userinfo', $pag);
        $this->assign('page', $pag->render());
        return $this->fetch('/admin_index');
    }

    // 未读列表
    public function unread() {
        $useinfo = new PluginUserInfoModel();
        $pag = $useinfo->order('create_time', 'id')->where('status', 0)->paginate(20);
        $res = $useinfo->where('status', 0)->select();
        $this->assign('unreadcount', $res->count());
        $this->assign('userinfo', $pag);
        $this->assign('page', $pag->render());
        return $this->fetch('/admin_unread');
    }

    // 取消未读用户信息
    public function cancelUnread() {
        if($this->request->isPost()){
            $res = PluginUserInfoModel::where('status', 0)->update(['status' => 1]);
            if($res != 0){
                $this->success('标记成功'); die;
            }
        }
        $this->error('更新错误');
    }

    // 查看列表
    public function messageCheck() {
        $userinfo = new PluginUserInfoModel();

        $id = $this->request->param('id');
        $da = $userinfo->get($id);
        $da->status = 1;
        $da->update();
        $da->save();
        $res = $userinfo->where('status', 0)->select();
        $this->assign('unreadcount', $res->count());
        $this->assign('info', $da);
        return $this->fetch('/admin_check');
    }

    // 删除
    public function delete() {
        $id = $this->request->param('id');
        if ($id){
            $da = PluginUserInfoModel::destroy($id);
            if ($da) {
                $this->success('删除成功', cmf_plugin_url('userInfo://AdminIndex/Index')); die;
            }
        }
        $this->error('删除出错');
    }
    
    // 下载数据表 
    public function downloadexcel() {
        if ($this->request->isPost()){
            // 保存的文件名;
            $excelname = $this->request->param('excelname');
            $excelname = $excelname ? $excelname: date('Y-m-d H:i:s');
            Loader::import('PHPExcel.PHPExcel');
            Loader::import('PHPExcel.PHPExcel.IOFactory.PHPExcel_IOFactory');
            Loader::import('PHPExcel.PHPExcel.Reader.Excel2007');
            $objPHPExcel = new \PHPExcel();
            //设置每列的标题
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID')
                ->setCellValue('B1', '客户名称')
                ->setCellValue('C1', '公司')
                ->setCellValue('D1', '手机')
                ->setCellValue('E1', '地址')
                ->setCellValue('F1', '内容')
                ->setCellValue('G1', 'ip地址')
                ->setCellValue('H1', '创建时间');
            $data = PluginUserInfoModel::all();
            //存取数据  这边是关键
            foreach ($data as $k => $v) {
                $num = $k + 2;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $num, $v['id'])
                    ->setCellValue('B' . $num, $v['name'])
                    ->setCellValue('C' . $num, $v['company'])
                    ->setCellValue('D' . $num, $v['phone'])
                    ->setCellValue('E' . $num, $v['site'])
                    ->setCellValue('F' . $num, $v['description'])
                    ->setCellValue('G' . $num, $v['ip'])
                    ->setCellValue('H' . $num, $v['create_time']);
            }
            //设置工作表标题
            $objPHPExcel->getActiveSheet()->setTitle('用户信息文档');
            //设置列的宽度
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $objPHPExcel->setActiveSheetIndex(0);
            $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=" . $excelname . '.xlsx');//设置文件标题
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            return ;
        }
        return ;
    }
}
