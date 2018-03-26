<?php
    /**
     * Created by PhpStorm.
     * User: Tom
     * Date: 2018/3/26
     * Time: 16:26
     */

    namespace app\index\controller;


    use app\admin\model\Cate;

    class CateList extends base
    {
        public function index(){
            $cateid = input('cateid');
            $cate = new Cate;
            $data = $cate->field('catename')->find($cateid);
            $catename=$data['catename'];
            $article = new \app\admin\model\Article();
            $artres = $article->order('id desc')
                              ->where('cateid','=',$cateid)
                              ->paginate(2);
            $this->assign('artres',$artres);
            $this->assign('catename',$catename);
            return $this->fetch('list');

        }
    }