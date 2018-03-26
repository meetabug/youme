<?php
    /**
     * Created by PhpStorm.
     * User: Tom
     * Date: 2018/3/26
     * Time: 15:26
     */

    namespace app\index\controller;


    class Article extends base
    {
        public function index(){
            $id = input('artid');
            $article = new \app\admin\model\Article;
            $article->where('id','=', $id)->setInc('click');
            $arts=$article->alias('a')
                          ->join(['ym_cate'=>'c'],'a.cateid=c.id ','left')
                          ->field('a.keywords,a.title,a.content,a.time,a.click,a.id,a.cateid,c.catename')
                          ->find($id);

            $prev=$article->where('id','<',$id)
                          ->where('cateid','=',$arts['cateid'])
                          ->order('id desc')
                          ->limit(1)
                          ->value('id');

            $next=$article->where('id','>',$id)
                          ->where('cateid','=',$arts['cateid'])
                          ->order('id desc')
                          ->limit(1)
                          ->value('id');


            $this->assign('arts',$arts);
            $this->assign('prev',$prev);
            $this->assign('next',$next);

            return $this->view->fetch('article');
        }

    }