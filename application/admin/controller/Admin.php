<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/21
 * Time: 18:01
 */

namespace app\admin\controller;


use think\Db;
use think\facade\Validate;

class Admin extends common
{
    protected  $db;
    protected  $validate;
    public function initialize(){
        $this->db=new \app\admin\model\Admin;
        $this->validate =new \app\admin\validate\Admin;
    }
    public function index(){

        $data = $this->db ->admins();
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function edit(){
        $id = input('id');
        if($this->request->isPost()){
            $admin = $this->db->admin($id);
            $password = $admin['password'];
            $data = [
                'id'=>input('id'),
                'username'=>input('username'),
                'password'=>input('password')?md5(input('password')):$password,
            ];
            if($this->validate->scene('edit')->check($data)){
                if($this->db->changeData($data)){
                    $this->success('修改成功','index');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error($this->validate->getError());
            }
        }
        $data= $this->db->admin($id);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function add(){
        if($this->request->isPost()){
            $data = [
                'username'=>input('username'),
                'password'=>input('password'),
            ];

            if($this->validate->scene('add')->check($data)){
                if($this->db->insert($data)){
                    $this->success('添加成功','index');
                }else{
                    $this->error('添加失败');
                }
            }else{
                    $this->error($this->validate->getError());
            }
        }
        return $this->fetch();
    }
    public function del(){
       $id = input('id');
       if($id == 1){
           return $this->error('初始化管理员不允许删除！');
       }
       if($this->db->destroy($id)){
           return $this->success('删除成功','index');
       }else{
           return $this->error('删除失败');
       }
    }
}
