<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/23
 * Time: 9:28
 */

namespace app\admin\validate;


use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'id'=> 'require',
        'catename' =>"require|unique:cate",
        'keywords' =>'require',
    ];
    protected $message = [
        'id.require'   =>'参数错误',
        'catename.require' => '栏目名称不能为空',
        'catename.unique'=>'栏目名称不能重复',
        'keywords.require' => '栏目关键词不能为空',
    ];

    protected $scene = [
        'edit' => ['id','catename','keywords'],
        'add'  => ['catename','keywords'],
    ];
}