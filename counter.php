<?php
//记录访问次数
session_name('CounterV');
session_start();
$vfn = 'CounterV.txt';
$v = 0;
if (($v = file_get_contents($vfn)) === false)
{
	$v = 0;
}
if (!isset($_SESSION['CounterV']))
{
	if (($vfp = @fopen($vfn, 'w')) !== false)
	{
		if (flock($vfp, LOCK_EX))
		{
			$v++;
			fwrite($vfp, $v, strlen($v));
			flock($vfp, LOCK_UN);
			$_SESSION['CounterV'] = 1;
		}
		fclose($vfp);
	}
}
?>