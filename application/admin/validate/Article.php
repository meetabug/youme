<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/23
 * Time: 16:03
 */

namespace app\admin\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'id'        =>'require',
        'title'     =>'require|max:100|unique:article',
        'keywords'  =>'require',
    ];
    protected $message = [
        'id.require'   => "参数错误",
        'title.require'=>"标题不能为空",
        'title.max'    =>'标题不能大于100位',
        'title.unique' =>'标题不能重复',
        'keywords.require'  =>'关键字不能为空',

    ];
    protected $scene = [
        'add' =>['title','keywords'],
        'edit'=>['id','title','keywords'],
    ];
}