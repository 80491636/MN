<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Article extends Controller
{
    //文章列表
    public function lst()
    {    
        $list=db('article')->alias('a')->join('imglst c','c.id=a.cataid')->field('a.id,a.title,a.pic,a.author,a.state,c.title')->paginate(10);
        // dump($list);die;
        // $list[$i]['pic'] = str_replace('https://img.tp8.com','http://img.perichina.cn',$list[$i]['pic']);
        $this->assign([
            'list'=>$list,
        ]);
        return $this->fetch();
    }
    //添加文章
    public function add()
    {    
        if(request()->isPost())
        {
            $data = [
                'title' => input('title'),
                'author' => input('author'),
                'keywords' => input('keywords'),
                'describe' => input('describe'),
                'pic' => input('pic'),
                'content' => input('content'),
                'cataid' => input('cataid'),
                'time'=>date("Y-m-d"),
            ];
            if(input('state')=='on'){
                $data['state']=1;
            }
            $file = request()->file('pic');
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                if($info){
                    $data['pic'] = $info->getSaveName();
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }

            if(db('article')->insert($data))
            {
                $this->success('文章添加成功!','lst');
            }
            else
            {
                $this->error('文章添加失败！');
            }
        }

        $catares = db('catalog')->select();
        $this->assign([
            'catares'=>$catares,
        ]);
        return $this->fetch();
	}
	//编辑文章  问题：编辑提交后没有pic值  keywords值不对 cataid值没有
    public function edit()
    {    
        //接受数据并更新
        if(request()->isPost())
        {
            $data = [
                'id' => input('id'),
                'title' => input('title'),
                'author' => input('author'),
                'keywords' => input('keywords'),
                'describe' => input('describe'),
                'pic' => input('pic'),
                'content' => input('content'),
                'cataid' => input('cataid'),
                'time'=>date("Y-m-d"),
            ];
            if(input('state')=='on'){
                $data['state']=1;
            }else{
                $data['state']=0;
            }
            $file = request()->file('pic');
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                if($info){
                    $data['pic'] = $info->getSaveName();
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }

            if(db('article')->update($data))
            {
                $this->success('文章修改成功!','lst');
            }
            else
            {
                $this->error('文章修改失败！');
            }
        }
        //发送原始数据
        $id = input('id');
        $list = db('article')->find($id);
        $catares = [];
        // $catares = db('imglst')->select();
        // dump(json_decode($list['keywords']));die;
        $list['pic'] = str_replace('https://img.tp8.com','http://img.perichina.cn',$list['pic']);
        $list['keywords'] = json_decode($list['keywords']);
        $this->assign([
            'list' => $list,
            'catares' => $catares,
        ]);
        return $this->fetch();
	}
	//删除文章
	public function del()
	{
        $id = input('id');
        if(db('article')->delete($id))
        {
            $this->success('删除文章成功！','lst');
        }
        else
        {
            $this->error('删除文章失败');
        }
		return $this->fetch();
	}

}
