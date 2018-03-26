<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2018/3/21
 * Time: 14:22
 */

namespace app\admin\model;


use think\Model;
use think\facade\Session;
class Admin extends Model
{
    protected  $table = "ym_admin";
    public function login($username,$password){
        $data = $this->where(['username'=>$username])->find();
        if($data){
            if($data['password'] == md5($password)){
                Session::set('id',$data['id']);
                Session::set('username',$data['username']);
                return ['code'=>1,'msg'=>'登陆成功'];
            }else{
                return ['code'=>0,'msg'=>'密码错误'];
            }
        }else{
            return ['code'=>2,'msg'=>'用户不存在'];
        }

   }
   public function admins(){
           $data = $this->all();
           return $data;
   }
   public function admin($id){
        $data = $this->get($id);
        return $data;
   }
   public function changeData($data){
        return $this->update($data);
   }
}