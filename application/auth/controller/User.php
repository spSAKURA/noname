<?php
namespace app\auth\controller;

use app\auth\model\User as UM;
use app\auth\model\Role ;
use app\auth\model\Route ;
use think\Session;
/**
 * 控制用户权限逻辑 
 */
class User {
    /**
     * $rule 用户角色
     * 0 为未登陆用户角色
     * 数据看可配置
     */
    protected $role_id = '0' ;
    /**
     * $route 用户路由表 按照用户角色生成
     */
    protected $route = [] ;

    /**
     * 验证登录
     */
    public function __construct(){
        if(Session::has('user')){
            $this->isLogined();
        }else{
            //未登录用户role_id即为0 直接获取路由表
            $this->getUserRouteList();
        }
    }
    /**
     * isLogined 登录用户无需查询数据库 取session 数据
     */
    protected function isLogined(){
        //do some thing
    }

    public function getRule(){
        return $this->$role_id;
    }

    public function getRouteList(){
        return $this->route;
    }
    /**
     * checkLogin 登录验证
     * @login_info 用户表单信息
     */
    public function checkLogin($login_info){
        $um = new UM();
        if($um->login($login_info)){
            return $this->login($um);
        }else{
            return $this->loginFalt($um);
        }

    }
    /**
     * 验证后登陆操作
     */
    protected function login(UM $um){
        $role = new Role();
        $this->$role_id = $role->getRoleID($um->getUserID());
        $this->getUserRouteList();
        return $this;
    }

    protected function getUserRouteList(){
        $route = new Route();
        $this->route = $route->getRouteList($this->role_id);
    }

    protected function loginFalt(UM $um){
        return $this;
    }


}