<?php
#声明命名空间
namespace Admin\Controller;
#引入父类元素
use Think\Controller;
#声明类并且继承父类
class PublicController extends Controller{
	public function login(){
		$this -> display();
	}
	#验证码方法
	public function captcha(){
		#配置
		$cfg = array(
				'fontSize' => 12,
				'imageH'   => 40,
				'imageW'   => 80,
				'length'   => 4,
				'fontttf'  => '4.ttf',
			);
		
		#实例化
		$verify = new \Think\Verify($cfg);
		#输出验证码
		$verify -> entry();
	}
	#登录验证
	public function check(){
		#接受数据
		$post = I('post.');
		#验证验证码
		$verify = new \Think\Verify();
		#验证
		$rst = $verify -> check($post['captcha']);
		#判断验证码是否正确
		if($rst){
			#判断用户名和密码
			$model = M('User');
			#删除验证码元素
			unset($post['captcha']);
			#查询
			$data = $model -> where($post) -> find();
			#判断用户是否存在
			if($data){
				#会话控制记录用户登录信息
				session('uid',$data['id']);//记录用户id
				session('uname',$data['username']);//记录用户名
				session('role_id',$data['role_id']);//记录角色id
				#提示成功
				$this -> success('登录成功',U('Index/index'),3);
			}else{
				#用户或者密码错误
				$this -> error('验证码错误。。。',U('login'),3);
			}
			
		}else{
			#验证码错误
			$this -> error('验证码错误。。。',U('login'),3);
		}
	}

	//用户退出
	public function logout(){
		#清空session
		session(null);
		if(!session('?uid')){
			#清空成功
			$this -> success('退出成功',U('login'),3);
		}
	}
}