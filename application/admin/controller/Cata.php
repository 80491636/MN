<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Cata extends Controller
{
	//栏目列表
    public function lst()
    {   
		$list = db('catalog')->paginate(10);
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
				'cataname' => input('cataname'),
				'illustrate' => input('illustrate'),
			];
			if(db('catalog')->insert($data))
			{
				$this->success('添加栏目成功！','lst');
			}else{
				$this->error('添加失败!');
			}
		}

        return $this->fetch();
	}
	//编辑栏目
    public function edit()
    {       
		$id = input('id');
		$list = db('catalog')->find($id);

		if(request()->isPost())
		{
			$data = [
				'id' => input('id'),
				'cataname' => input('cataname'),
				'illustrate' => input('illustrate'),
			];
			if(db('catalog')->update($data))
			{
				$this->success('修改信息成功！','lst');
			}
			else
			{
				$this->error('修改信息错误！');
			}
		}
		$this->assign([
			'list' => $list,
		]);
        return $this->fetch();
	}
	
	public function del()
	{
		$id = input('id');
		if(db('catalog')->where('id',$id)->delete())
		{
			$this->success('删除信息成功！','lst');
		}
		else
		{
			$this->error('删除失败!');
		}
	}

}
