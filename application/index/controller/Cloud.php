<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Cloud extends Controller
{
    public function index()
    {
        $tags =  Db::table('tags')->order('id asc')->select();
        $this->assign([
            'tags'=>$tags,
            'pretag' =>'',
        ]);
        return $this->fetch('cloud');
    }
}
