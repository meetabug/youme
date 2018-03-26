<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/22
 * Time: 16:24
 */

namespace app\admin\controller;


class Cate extends common
{
    protected  $db;
    protected  $validate;
    protected function initialize()
    {
        $this->db = new \app\admin\model\Cate;
        $this->validate =new \app\admin\validate\Cate;
    }

    public function index(){
        $data=$this->db->all();
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function add(){
        if($this->request->isPost()){
            $data = [
                'catename' =>input('catename'),
                'keywords' =>input('keywords'),
                'desc'     =>input('desc'),
                'type'     =>input('type')?input('type'):0,

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
                'id' => input('id'),
                'catename' =>input('catename'),
                'keywords' =>input('keywords'),
                'desc'     =>input('desc'),
                'type'     =>input('type')?input('type'):0,
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
        $id = input('id');
        if($this->db->destroy($id)){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败');
        }
    }
}