<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Lst extends Controller
{
    public function index()
    {
<<<<<<< HEAD
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
=======
        $cataid = input('id');
        $tagids = db('tags')->where('cataid',$cataid)->order('id asc')->field('id,tagname')->select();
        $peri = db('imglst')->where('tagid','>=',$tagids[0]['id'])->where('tagid','<=',$tagids[count($tagids)-1]['id'])->order('id desc')->paginate(20);
        // dump($list);die;
        //美女图片
        // $peri =  Db::table('taglist')->where('catalog' ,'美女模特')->order('id asc')->paginate(20);
        //热门标签
        $tags = db('tags')->where('id > 31')->where('id < 143')->orderRaw('rand()')->limit(17)->select(); 

        $referrer=db('imglst')->where('tagid','>=',$tagids[0]['id'])->where('tagid','<=',$tagids[count($tagids)-1]['id'])->orderRaw('rand()')->limit(10)->select(); 
        // $tags =  Db::table('tags')->where('catalog' ,'特征美女')->order('id asc')->limit(17)->select();
        //推荐
        // $referrer =  Db::table('taglist')->where('catalog' ,'特征美女')->order('id asc')->limit(10)->select();
>>>>>>> 7e7d444fde09e3e25ef4ae0e042c9a5ec088e6be
        $this->assign([
            'peri' => $peri,
            'tags' => $tags,
            'referrer' => $referrer,
            'subtag' => $subtag,
            'site' => $site,
        ]);
        return $this->fetch('Lst');
    }
}
