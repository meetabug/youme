<?php


    namespace app\index\controller;


    use app\admin\model\Cate;
    use think\Controller;

    class base extends Controller
    {
        public function initialize()
        {
           $this->nav();
        }
        public function nav(){
            $cate = new Cate;
            $navres = $cate->order('id asc')
                            ->select();
            $this->assign('navres',$navres);
        }
    }