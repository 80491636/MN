<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Tag extends Controller
{
	//栏目列表
    public function lst()
    {    
		$list=db('tags')->alias('a')->join('catalog c','c.id=a.cataid')->field('a.id,a.tagname,a.url,a.source,c.cataname')->paginate(10);
		$this->assign([
			'list' => $list,
		]);
        return $this->fetch();
	}
	//添加栏目
    public function add()
    {    
		if(request()->isPost()){
			$data = [
				'tagname' => input('tagname'),
				'cataid' => input('cataid'),
				'url' => input('url'),
				'source' => input('source'),
			];
			if(db('tags')->insert($data))
			{
				$this->success('添加tag成功！','lst');
			}else{
				$this->error('添加tag失败!');
			}
		}
        //发送原始数据
        $catares = db('catalog')->select();
        $this->assign([
            'catares' => $catares,
        ]);
        return $this->fetch();
	}
	//编辑栏目
    public function edit()
    {    
		if(request()->isPost()){
			$data = [
				'id' => input('id'),
				'tagname' => input('tagname'),
				'cataid' => input('cataid'),
				'url' => input('url'),
				'source' => input('source'),
			];
			if(db('tags')->update($data))
			{
				$this->success('添加tag成功！','lst');
			}else{
				$this->error('添加tag失败!');
			}
		}
		//发送原始数据
		$id = input('id');
		$list = db('tags')->find($id);
        $catares = db('catalog')->select();
        $this->assign([
			'list' => $list,
            'catares' => $catares,
        ]);
        return $this->fetch();
	}
	
	public function del()
	{
		$id = input('id');
		if(db('tags')->where('id',$id)->delete())
		{
			$this->success('删除tag信息成功！','lst');
		}
		else
		{
			$this->error('删除tag失败!');
		}
	}

}
