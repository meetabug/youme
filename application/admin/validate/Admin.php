<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/22
 * Time: 14:57
 */

namespace app\admin\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule =[
            'id' =>'require' ,
            'username'=>'require',
            'password'=>'require',

        ];
    protected $message =[
            'id.require'=>'参数错误',
            'username.require'=>'请填写用户名',
            'password.require'=>'请填写密码',
    ];
    protected $scene = [
        'edit' => ['id','username','password'],
        'add'  => ['username','password'],
    ];
}