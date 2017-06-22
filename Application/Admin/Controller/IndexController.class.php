<?php
#命名空间
namespace Admin\Controller;
#引用父类
use Think\Controller;
#继承父类
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function home(){
    	$this -> display();
    }
}