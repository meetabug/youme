<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/23
 * Time: 14:43
 */

namespace app\admin\validate;


use think\Validate;

class Link extends Validate
{
    protected $rule = [
        'id'    =>'require',
        'title' =>'require|max:25|unique:link',
        'url'   => 'require|url'
    ];
    protected $message = [
        'id.require'         =>'参数错误',
        'title.require'      =>'链接标题不能为空',
        'title.max'          =>'链接标题不能大于25位',
        'title.unique'       =>'链接标题重复了',
        'url.require'        =>'链接url不能为空',
        'url.url'            =>'链接url格式错误',
    ];
    protected $scene = [
        'add' => ['title','url'],
        'edit'=> ['id','title','url'],
    ];
}