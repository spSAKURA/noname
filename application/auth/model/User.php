<?php
namespace app\auth\model;

use think\model;

class User extends model{
    public function login(){
        return $login_info;
    }
}