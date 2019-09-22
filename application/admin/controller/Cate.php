<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Cate extends Controller
{
    public function lst()
    {       
        return $this->fetch();
	}
    public function add()
    {       
        return $this->fetch();
	}
	
    public function edit()
    {       
        return $this->fetch();
	}
	
	public function del()
	{
		return $this->fetch();
	}

}
