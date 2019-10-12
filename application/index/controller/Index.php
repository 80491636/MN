<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
    public function index()
    {
        //最新图片
        $news = db('imglst')->order('id desc')->limit(6)->select();
        //美女图片
        $peri =  db('imglst')
        ->alias('a')
        ->join('tags c','a.tagid = c.id')
        ->join('catalog d','c.cataid = d.id')
        ->where(array('d.cataname' => '美女模特'))
        ->order('a.time desc')
        ->limit(10)
        ->select();
        
        //纹身图片
        $tattoo =  db('imglst')
        ->alias('a')
        ->join('tags c','a.tagid = c.id')
        ->join('catalog d','c.cataid = d.id')
        ->where(array('d.cataname' => '纹身图片'))
        ->order('a.time desc')
        ->limit(10)
        ->select();
        // dump($tattoo);die;
        $this->assign([
            'news'=> $news,
            'peri' => $peri,
            'tattoo' => $tattoo,
            ]);
       
        return $this->fetch();
    }
}
