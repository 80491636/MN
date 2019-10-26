<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Tags extends Controller
{
    public function index()
    {
        $tagid = input('tagid');
        //tag图片
        $peri =  db('catalog')
        ->alias('a')
        ->join('tags b','b.cataid = a.id')
        ->join('imglst c','c.tagid = b.id')
        ->where(array('c.tagid' => $tagid))
        ->order('c.time desc')
        ->paginate(20);

        // dump(count($peri));die;
        //没有值默认 7 美女模特
        // $cataid = input('cataid') ? input('cataid') : 7;
        //相关标签
        $tags =  db('tags')->orderRaw('rand()')->limit(17)->select();
        //相关图片
        $referrer =  db('imglst')->orderRaw('rand()')->limit(10)->select();
        $this->assign([
            'peri' => $peri,
            'tags' => $tags,
            'referrer' => $referrer,
        ]);
        return $this->fetch('tags');

    }


}
