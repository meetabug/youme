<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/23
 * Time: 16:01
 */

namespace app\admin\controller;

use app\admin\model\Cate;
class Article extends  common
{
    protected  $db;
    protected  $validate;
    protected  $cate_db;
    protected function initialize()
    {
        $this->db = new \app\admin\model\Article;
        $this->validate = new \app\admin\validate\Article;
        $this->cate_db = new Cate;
    }

    public function index(){
        $data = $this->db->alias('a')->join(['ym_cate'=>'c'] ,'a.cateid=c.id','left')->field('a.id,a.title,a.pic,a.click,a.time,c.catename')->paginate(3);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function add(){
        if($this->request->isPost()){
            $data = [
                'title'     =>input('title'),
                'keywords'  =>input('keywords'),
                'desc'      =>input('desc'),
                'content'   =>input('content'),
                'cateid'    =>input('cateid'),
                'time'      =>time(),
            ];
            if($_FILES['pic']['tmp_name']){
                $file = $this->request->file('pic');
                $info = $file->move('./static/uploads/');
                if($info){
                    $data['pic']='/static/uploads/'.date('Ymd').'/'.$info->getFilename();
                }else{
                    return $this->error($file->getError()) ;
                }
            }
            if($this->validate->scene('add')->check($data)){
                if($this->db->insert($data)){
                   return $this->success('添加成功','index');
                }else{
                    return $this->error('添加失败');
                }
            }else{
                return $this->error($this->validate->getError());
            }
        }
        $cateres =$this->cate_db ->all();
        $this->assign('cateres',$cateres);
        return $this->fetch();
    }
    public function edit(){
        if($this->request->isPost()){
            $data = [
                'id'        =>input('id'),
                'title'     =>input('title'),
                'keywords'  =>input('keywords'),
                'desc'      =>input('desc'),
                'content'   =>input('content'),
                'cateid'    =>input('cateid'),
            ];
            if($_FILES['pic']['tmp_name']){
                $file = $this->request->file('pic');
                $info = $file->move('./static/uploads/');
                if($info){
                    $data['pic']='/static/uploads/'.date('Ymd').'/'.$info->getFilename();
                }else{
                    return $this->error($file->getError()) ;
                }
            }
            if($this->validate->scene('edit')->check($data)){
                if($this->db->update($data)){
                    return $this->success('修改成功','index');
                }else{
                    return $this->error('修改失败');
                }
            }else{
                return  $this->error($this->validate->getError());
            }
        }
        $id = input('id');
        $article = $this->db->get($id);
        $cateres = $this->cate_db ->all();
        $this->assign('article',$article);
        $this->assign('cateres',$cateres);
        return $this->fetch();
    }
    public function del(){
        $id  = input('id');
        if($this->db->destroy($id)){
            return $this->success('删除成功');
        }else{
            return $this->error('删除失败');
        }
    }
}