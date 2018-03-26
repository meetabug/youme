<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/21
 * Time: 16:15
 */

namespace app\admin\controller;


class Index extends common
{
    public function index(){
        $info=[
            'OS'             =>PHP_OS,
            'SOFTWARE'       =>$_SERVER["SERVER_SOFTWARE"],
            'PHP_RUN_METHOD' =>php_sapi_name(),
            'UPLOAD'         =>ini_get('upload_max_filesize'),
            'TIME'           =>date("Y年n月j日 H:i:s"),
            'HOST'           =>$_SERVER['SERVER_NAME'],
            'IP'             =>gethostbyname($_SERVER['SERVER_NAME']),
        ];
        $this->assign('info',$info);
        return $this->fetch();
    }
}