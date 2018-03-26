<?php
namespace app\admin\controller;

/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/21
 * Time: 10:07
 */
use app\admin\model\Admin;
use think\Controller;
use think\facade\Session;

class Login extends Controller{

    public function login (){
        if($this->request->isPost()){
            $admin=new Admin;
            $status=$admin ->login(input('username'),input('password'));
            if($status['code'] ==1){
                return $this->success($status['msg'],'index/index');
            }elseif($status['code'] ==0){
                return $this->error($status['msg']);
            }elseif($status['code'] ==2){
                return $this->error($status['msg']);
            }
        }

        return $this->fetch('login');
    }
    public function logout(){
            Session::clear();
            return $this->success('退出成功!','login');
    }
}