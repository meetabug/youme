<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/22
 * Time: 9:25
 */

namespace app\admin\controller;


use think\Controller;
use think\Request;

class common extends Controller
{
    public function __construct(Request $request=null)
    {
        parent::__construct($request);
        if(!session('id')){
            $this->redirect('admin/login/login');
        }
    }
}