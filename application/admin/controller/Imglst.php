<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Imglst extends Controller
{
    public function lst()
    {
        $list=db('imglst')->alias('a')->join('tags c','c.id=a.tagid')->field('a.id,a.title,a.cover,c.tagname')->paginate(10);
        $this->assign([
            'list' => $list,
        ]);
        return $this->fetch();
    }
    public function add()
    {
        if(request()->isPost())
        {
            $data = [
                'title' => input('title'),
                'tagid' => input('tagid'),
                'cover' => input('cover'),
                'url' => input('url'),
                'time' => date("Y/m/d"),
            ];
            if(db('imglst')->insert($data))
            {
                $this->success('添加封面成功','lst');
            }
            else{
                $this->error('添加封面失败');
            }
        }
        $tagres = db('tags')->select();
        $this->assign([
            'tagres' => $tagres,
        ]);
        return $this->fetch();
    }
    public function edit()
    {
        if(request()->isPost())
        {
            $data = [
                'id' => input('id'),
                'title' => input('title'),
                'tagid' => input('tagid'),
                'cover' => input('cover'),
                'url' => input('url'),
                'time' => date("Y/m/d"),
            ];
            if(db('imglst')->update($data))
            {
                $this->success('编辑封面成功','lst');
            }
            else{
                $this->error('编辑封面失败');
            }
        }
        $id = input('id');
        $list = db('imglst')->where('id',$id)->find();
        $tagres = db('tags')->select();
        $this->assign([
            'list' => $list,
            'tagres' => $tagres,
        ]);
        return $this->fetch(); 
    }
    public function del()
    {
        $id = input('id');
        if(db('imglst')->delete($id))
        {
            $this->success('删除封面成功！','lst');
        }
        else
        {
            $this->error('删除封面失败');
        }
		return $this->fetch();
    }

}
