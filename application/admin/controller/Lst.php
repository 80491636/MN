<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Lst extends Controller
{
    public function index()
    {
        return $this->fetch('Lst');
    }
}
