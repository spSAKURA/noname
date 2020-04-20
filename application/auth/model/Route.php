<?php
namespace app\auth\model;

use think\Model;

class Route extends Model{

    protected $table = 'route r';

    public function getRouteList($role_id){
        return $this
            ->join('role_route rr','r.id = rr.route_id')
            ->where('rr.role_id',$role_id)
            ->column('r.id , r.route , r.controller , r.method');
    }

}
