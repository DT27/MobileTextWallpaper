<?php
date_default_timezone_set('PRC');
require_once 'db.php';
//记录访问次数
session_name('CounterV'.$ymd);
session_start();
$v = 0;
$g = 0;
$ymd = date("Ymd");
$db=new DB;
$sql="select * from Counter where Day = ".$ymd; 
$row=$db->get_one($sql); 
if ($row) {
	$v = $row['CounterV'];
	$g = $row['CounterG'];
}else {
	$dataArray=array(
     'CounterV'=>0,
     'CounterG'=>0,
     'Day'=>$ymd
    );
	$db->insert('Counter',$dataArray);
}
if (!isset($_SESSION['CounterV'.$ymd]))
{
	$v++;
	$dataArray=array(
     'CounterV'=>$v
    );
	$db->update('Counter',$dataArray,"Day=".$ymd);
	$_SESSION['CounterV'.$ymd] = 1;
}
echo $v."人服务, 生成".$g;
?>