<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Cloud extends Controller
{
    public function index()
    {
        $tags = db('tags')
        ->alias('a')
        ->join('catalog b','a.cataid = b.id')
        // ->where(array('d.cataname' => '美女模特'))
        ->order('b.cataname desc')
        // ->limit(10)
        ->select();
        // dump($tags);die;
        $this->assign([
            'tags'=>$tags,
            'pretag' =>' ',
        ]);
        return $this->fetch('cloud');
    }
}
