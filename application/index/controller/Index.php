<?php
namespace app\index\controller;

use app\admin\model\Article;

class Index extends base
{
    public function index()
    {
        $article = new Article;

        $artres=$article->alias('a')
            ->join(['ym_cate'=>'c'],'a.cateid=c.id','left')
            ->field('a.id,a.title,a.pic,a.time,a.desc,a.click,a.keywords,c.catename')
            ->order('a.id desc')
            ->paginate(2);
        $this->assign('artres',$artres);
        return $this->view->fetch();
    }



}
