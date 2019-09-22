<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Lst extends Controller
{
    public function index()
    {
        //美女图片
        $peri =  Db::table('taglist')->where('catalog' ,'美女模特')->order('id asc')->paginate(20);
        //热门标签
        $tags =  Db::table('tags')->where('catalog' ,'特征美女')->order('id asc')->limit(17)->select();
        //推荐
        $referrer =  Db::table('taglist')->where('catalog' ,'特征美女')->order('id asc')->limit(10)->select();
        $this->assign([
            'peri' => $peri,
            'tags' => $tags,
            'referrer' => $referrer,
        ]);
        return $this->fetch('Lst');
    }
}
