<?php
namespace app\auth\controller;

use think\Route as ThinkRoute;

use app\auth\controller\User;

#按照用户角色生成路由

class Route {

    public static function bind(User $user){

        $routeList = $user->getRouteList();

        foreach($routeList as $one_route){
            ThinkRoute::{$one_route['method']}($one_route['route'],$one_route['controller']);
        }
    }
}