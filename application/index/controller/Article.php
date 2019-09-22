<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Article extends Controller
{
    public function index()
    {
        $lstid = input('taglistid');
        $lst =  Db::table('imgcontent')->where('taglistid' ,$lstid)->order('id asc')->paginate(1);
        $this->assign([
            'lst'=>$lst,
        ]);
        return $this->fetch('Article');
    }
}
