<?php
//命名空间
namespace Admin\Controller;
//引入父类元素
use Think\Controller;
//声明并且继承父类
class UserController extends Controller{
	//add方法展示添加页面的模板
	public function add(){
		//实例化模型
		$model = M('Dept');
		//查询部门信息
		$data = $model -> select();
		//传递给模板
		$this -> assign('data',$data);
		//展示模板
		$this -> display();
	}
	//addOk方法
	public function addOk(){
		//接收数据
		$post = I('post.');
		#添加addtime字段的值
		$post['addtime'] = time();
		//实例化模型
		$model = M('User');
		#数据对象的创建
		$model -> create($post);
		#入库操作
		$rst = $model -> add();
		#针对写入返回结果进行判断
		if($rst){
			#写入成功
			$this -> success('添加成功',U('showList'),3);
		}else{
			#写入失败
			$this -> error('添加失败',U('add'),3);
		}

	}
	#showList展示模板的方法
	public function showList(){
		#实例化模型
		$model = M('User');
		#查询总的记录数
		$count = $model -> count();
		#实例化分页类，传递总的记录数，每页显示一条记录
		$page = new \Think\Page($count,3);
		#可选步骤。定义按钮的文字
		$page -> rollPage = 3;
		#让最后一页不显示数字
		$page -> lastSuffix = false;
		$page ->setConfig('prev','上一页');
		$page ->setConfig('next','下一页');
		$page ->setConfig('first','首页');
		$page ->setConfig('last','末页');
		#组装页码的地址
		$show = $page -> show();
		#通过limit方法限制输出的记录数
		$data = $model -> limit($page -> firstRow,$page -> listRows) -> select();
		#接收数据
		// $data = $model -> select();
		#传递数据
		$this -> assign('show',$show);
		$this -> assign('data',$data);
		#展示模板
		$this -> display();
	}
	#展示部门图表的功能
	public function charts(){
		#实例化模型
		$model = M();
		#连贯操作查询数据
		$data = $model -> field('t2.name,count(*) as count')
					   -> table('tp_user as t1,tp_dept as t2')
					   -> where('t1.dept_id = t2.id')
					   -> group('t2.name')
					   -> select();
		#处理数据
		$str = '[';
		#遍历数组
		foreach ($data as $key => $value) {
			#拼凑字符串
			$str = $str . "['" . $value['name'] . "'," . $value['count'] . "],";
		}
		#去除最后一个多余的逗号
		$str = rtrim($str,',') .']';
		#传递数据给模板
		$this -> assign('str',$str);
		#展示模板
		$this -> display();
	}
}