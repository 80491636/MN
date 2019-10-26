<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Article extends Controller
{
    public function index()
    {
        $imgid = input('imgid');
        //上一篇
        $prepage = db('article')->where('cataid',$imgid-1)->find();
        //列表
        $lst =  db('article')
        ->alias('a')
        ->join('imglst b','a.cataid = b.id')
        ->join('tags c','b.tagid = c.id')
        ->join('catalog d','d.id = c.cataid')
        ->where('a.cataid' ,$imgid)
        ->order('a.id asc')->paginate(1);
        // dump($lst);die;
        //下一篇
        $nextpage = db('article')->where('cataid',$imgid+1)->find();

        $this->assign([
            'lst'=>$lst,
            'prepage' => $prepage,
            'nextpage' => $nextpage,
        ]);
        return $this->fetch('Article');
    }
    //相关标签
    public function reltags()
    {

    }
}
