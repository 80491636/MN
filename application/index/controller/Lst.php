<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Lst extends Controller
{
    public function index()
    {
        //没有值默认 7 美女模特
        $cataid = input('cataid') ? input('cataid') : 7;
        //位置
        $site = db('catalog')->find($cataid);
        //相关子标签
        $subtag = db('tags')->where('cataid',$cataid)->orderRaw('rand()')->limit(3)->select();
        //美女图片
        $peri =  db('tags')->alias('a')->join('imglst b','b.tagid = a.id')->where('cataid',$cataid)->paginate(20);
        //相关标签
        $tags =  db('tags')->orderRaw('rand()')->limit(17)->select();
        //相关图片
        $referrer =  db('imglst')->orderRaw('rand()')->limit(10)->select();
        $this->assign([
            'peri' => $peri,
            'tags' => $tags,
            'referrer' => $referrer,
            'subtag' => $subtag,
            'site' => $site,
        ]);
        return $this->fetch('lst');
    }
}
