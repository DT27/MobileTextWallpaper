<?php
date_default_timezone_set('PRC');
require_once 'SQLiteHelper.php';
//记录访问次数
session_name('CounterV'.$ymd);
session_start();
$v = 0;
$g = 0;
$ymd = date("Ymd");
$db = new SQLiteHelper;
$result = $db->QuerySqlite('select * from Counter where Day = '.$ymd);
$row = sqlite_fetch_all($result);
if (count($row)) {
	$v = $row[0]['CounterV'];
	$g = $row[0]['CounterG'];
}else {
			$db->ExecSqlite('INSERT INTO Counter (Day) VALUES (' . $ymd . ')');
		}
if (!isset($_SESSION['CounterV'.$ymd]))
{
	$v++;
	$db->ExecSqlite('update Counter set CounterV = '.$v.' where Day = '.$ymd);
	$_SESSION['CounterV'.$ymd] = 1;
}
echo $v."人服务, 生成".$g;
?>