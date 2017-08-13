<?php
#声明命名空间
namespace Admin\Model;
#引入父类元素
use Think\Model;
#声明并继承父类

class StuModel extends Model{
	#当前模型需要关联的表
	protected $trueTableName = 'stu';
}