<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
    public function index()
    {
        //最新图片
        $news = Db::table('taglist')->order('id desc')->limit(6)->select();
        //美女图片
        $peri =  Db::table('taglist')->where('catalog' ,'美女模特')->order('id desc')->limit(10)->select();
        //纹身图片
        $tattoo =  Db::table('taglist')->where('catalog' ,'纹身图片')->order('id desc')->limit(10)->select();
        // $tattoo =  Db::name('taglist')
        // ->alias('a')
        // ->join('imgcontent b','a.id = b.taglistid')
        // ->where(array('a.catalog' => '纹身图片'))
        // ->order('b.time desc')
        // ->limit(10)
        // ->select();
        $this->assign([
            'news'=> $news,
            'peri' => $peri,
            'tattoo' => $tattoo,
            ]);
       
        return $this->fetch();
    }
}
