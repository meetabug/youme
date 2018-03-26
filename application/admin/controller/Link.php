<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/23
 * Time: 14:38
 */

namespace app\admin\controller;


class Link  extends common
{

    protected $db;
    protected $validate;
    protected function initialize()
    {
       $this->db=new \app\admin\model\Link;
       $this->validate = new \app\admin\validate\Link;

    }

    public function index(){
        $data=  $this->db->paginate(3);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function add(){
        if($this->request->isPost()){
            $data = [
                'title' =>input('title'),
                'desc'  =>input('desc'),
                'url'   =>input('url'),
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
    public function edit(){
        if($this->request->isPost()){
            $data = [
                'id'        =>input('id'),
                'title'     =>input('title'),
                'desc'      =>input('desc'),
                'url'       =>input('url'),
            ];
            if($this->validate->scene('edit')->check($data)){
                if($this->db->update($data)){
                    $this->success('修改成功','index');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error($this->validate->getError());
            }
        }
        $id  = input('id');
        $data = $this->db->get($id);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function del(){
        $id  = input('id');
        if($this->db->destroy($id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}