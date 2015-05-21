<?php
//设置页面内容是html编码格式是utf-8
//header("Content-Type: text/plain;charset=utf-8"); 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST,GET');
header('Access-Control-Allow-Credentials:true'); 
header("Content-Type: application/json;charset=utf-8"); 


//定义多维数组
$myarray= array
			(
				array("name" => "小a" , "number" => "01"),
				array("name" => "小a" , "number" => "02"),
				array("name" => "小a" , "number" => "03")
			);


//判断是“get”请求就进行查询，如果是“post”请求就进行新建
//$_SERVER是一个超全局变量，在一个脚本的任何地方都可使用，不用使用global关键字
//$_SERVER["REQUEST_METHOD"]返回访问页面的请求方法

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	search();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST"){
	create();
}

//通过编号查询员工资料
function search(){
	//检查是否有员工编号这个参数
	//isset检测变量是否设置，empty判断是否为空
	//超全局变量“$_GET”和“$_POST”用于收集表单数据
	if (!isset($_GET["number"]) || empty($_GET["number"])) {
		echo '{"success":false,"msg":"参数错误"}';
		return;
	}
	//global作用于函数内的全局变量
	global $myarray;
	//获取number参数
	$number = $_GET["number"];
	$result = '{"success":false,"msg":"没有找到员工。"}';
	
	//查找$myarray数组，查找key值为number的员工是否存在，如果存在返回相关数据
	foreach ($myarray as $value) {
		if ($value["number"] == $number) {
			$result = '{"success":true,"msg":"找到员工：员工编号：' . $value["number"] . 
							'，员工姓名：' . $value["name"] . '"}';
			break;
		}
	}
    echo $result;
}

//创建员工
function create(){
	//判断信息是否填完整
	if(!isset($_POST["name"])||empty($_POST["name"])
	    ||!isset($_POST["number"])||empty($_POST["number"])){
		echo '{"success":false, "msg":"参数错误"}';
		return;
	}
		echo '{"success":true, "msg":" 员工：' .$_POST["name"].'创建成功！"}';
	
}


