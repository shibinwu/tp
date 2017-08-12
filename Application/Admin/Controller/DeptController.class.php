<?php
#声明命名空间
namespace Admin\Controller;
#引入父类元素
use Think\Controller;
#声明并且继承父类
class DeptController extends Controller{
	#Add方法展示添加页面的模板
	public function add(){
		$this -> display();
	}

	#addOk方法，收集数据并且保存数据
	public function addOk(){
		#收集数据
		// $post = I('post.');
		#实例化模型
		$model = D('Dept');
		#创建数据对象
		$res = $model -> create();
		dump($res);die;
		#判断数据对象的返回结果
		if(!$rst){
			$this -> error($model -> getError(),U('add'),3);exit;
		}
		#数据入库
		$res = $model -> add($post);
		#判断添加情况
		if($res){
			#添加成功
			$this ->  success('添加成功',U('showList'),3);
		}else{
			#添加失败
			$this -> error('添加失败',U('add'),3);
		}
	}
}