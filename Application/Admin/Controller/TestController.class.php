<?php
#声明命名空间
namespace Admin\Controller;

#引入父类元素
use Think\Controller;

#定义类并且继承父类
class TestController extends Controller{

	#index方法，模板展示
	public function index(){

		$this-> display('index2');
	}

	#test1方法
	public function test1(){
		echo 'hello friend';
	}

	public function test2(){
		echo time();
	}

	public function test3(){
		$this->success('执行成功',U('test1'),3);
	}

	public function test4(){
		$this->error('执行失败',U('test2'),3);
	}


	public function test5(){
		$date = date('Y-m-d H:i:s',time());
		#传递变量
		$this -> assign('date',$date);
		#展示模板
		$this -> display();
	}

	#展示模板，模板常量替换机制
	public function test6(){
		$this -> display();
	}

	#普通实例化方式
	public function test7(){
		// $model = new \Admin\Model\DeptModel();
		$model = M(Dept);
		dump($model);
		// $model -> diy();
	}

	#增加操作
	public function test8(){
		#实例化模型
		$model = M('Dept');
		#定义数组
		$data = array(
				'name' => '财务部',
				'pid'  => '0',
				'sort' => '2',
				'remark'=> '财务部门'

			);
		#增加操作
		$rst = $model -> add($data);
		dump($rst);

	}


}