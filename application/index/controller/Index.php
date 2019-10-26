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
        //热门标签
        $hottag = db('tags')->where('cataid > 7')->where('cataid < 14')->orderRaw('rand()')->limit(10)->select(); 
        // dump($hottag);die;
        //美女图片
        $peri =  db('imglst')
        ->alias('a')
        ->join('tags c','a.tagid = c.id')
        ->join('catalog d','c.cataid = d.id')
        ->where(array('d.cataname' => '美女模特'))
        ->order('a.time desc')
        ->field('a.tagid,a.title,a.cover,a.time,c.id,c.cataid,c.tagname,d.id,d.cataname,a.id')
        ->limit(10)
        ->select();
        $peritag = db('tags')->where('cataid',7)->limit(3)->select();
        // dump($peri);die;
        //特征美女
        $trait  =  db('imglst')
        ->alias('a')
        ->join('tags c','a.tagid = c.id')
        ->join('catalog d','c.cataid = d.id')
        ->where(array('d.cataname' => '特征美女'))
        ->order('a.time desc')
        ->field('a.tagid,a.title,a.cover,a.time,c.id,c.cataid,c.tagname,d.id,d.cataname,a.id')
        ->limit(10)
        ->select();
        $traittag = db('tags')->where('cataid',8)->limit(3)->select();
        $this->assign([
            'news'=> $news,
            'peri' => $peri,
            'trait' => $trait ,
            'hottag' => $hottag,
            'peritag' => $peritag,
            'traittag' => $traittag,
            ]);
       
        return $this->fetch();
    }
}
