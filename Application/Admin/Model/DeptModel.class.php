<?php
#声明命名空间
namespace Admin\Model;
#引入父类元素
use Think\Model;
#声明并且继承父类
class DeptModel extends Model{
	#开启批量验证
	protected $patchValidate = true;
	#自动验证规则
	protected $_validate = array(
		//验证字段
		array('bumenmingcheng','require','部门名称不能为空！'),
		array('bumenmingcheng','','部门名称已存在！',0,'unique'),
		#排序字段的验证要求必须是数字
		array('paixu','number','排序必须是数字')
		// array('sort','is_numeric','排序必须是一个数字',0,'function')
		);
	#字段映射
	protected $_map = array(
			//表单中的name值 => 数据表中的字段名
			'bumenmingcheng' => 'name',
			'paixu'  =>  'sort',
			'beizhu' =>  'remark'
		);
	
}