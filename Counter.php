<?php
date_default_timezone_set('PRC');
require_once 'db.php';
//记录访问次数
$v = 0;
$g = 0;
$ymd = date("Ymd");
$db=new DB;
$sql="select * from Counter where Day = ".$ymd." LIMIT 1"; 
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
if (!$_COOKIE["CounterV".$ymd])
{
	$v++;
	$dataArray=array(
     'CounterV'=>$v
    );
	$db->update('Counter',$dataArray,"Day=".$ymd." LIMIT 1");
	setcookie("CounterV".$ymd, "1", time()+86400);
}
unset($db);
echo $v."人服务, 生成".$g;
?>