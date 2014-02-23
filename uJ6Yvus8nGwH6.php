<?php
	/******************************************************************************

	参数说明:
	$max_file_size  : 上传文件大小限制, 单位BYTE
	$destination_folder : 上传文件路径
	$watermark   : 是否附加水印(1为加水印,其他为不加水印);

	使用说明:
	1. 将PHP.INI文件里面的"extension=php_gd2.dll"一行前面的;号去掉,因为我们要用到GD库;
	2. 将extension_dir =改为你的php_gd2.dll所在目录;
	******************************************************************************/
	date_default_timezone_set ('PRC');
	//上传文件类型列表
	$uptypes=array(
		'image/jpg',
		'image/png',
		'image/jpeg',
		//'image/pjpeg',
		//'image/gif',
		//'image/bmp',
		//'image/x-png'
	);

	$max_file_size=5000000;     //上传文件大小限制, 单位BYTE
	$destination_folder="temp/"; //上传文件路径
	//允许上传的文件类型为:implode(', ',$uptypes)
	
	$id = $_REQUEST["type"];
	if($id ==11)
	$id=1;
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (!is_uploaded_file($_FILES["upfilet".$id][tmp_name]))
		//是否存在文件
		{
			echo "<script type=\"text/javascript\">alert('图片不存在！')</script>";
			exit;
		}

		$file = $_FILES["upfilet".$id];
		if($max_file_size < $file["size"])
		//检查文件大小
		{
			echo "<script type=\"text/javascript\">alert('图片文件太大，最大5MB！')</script>";
			exit;
		}

		if(!in_array($file["type"], $uptypes))
		//检查文件类型
		{

			echo "<script type=\"text/javascript\">alert('文件类型不符，仅可上传jpeg或png图片！')</script>";
			exit;
		}

		if(!file_exists($destination_folder))
		{
			mkdir($destination_folder);
		}

		$filename=$file["tmp_name"];
		$image_size = getimagesize($filename);
		$pinfo=pathinfo($file["name"]);
		$ftype=$pinfo['extension'];


		$FileID=date("Ymd_His") . '_' . rand(1000,9999);

		$destination = $destination_folder.$FileID."UP.".$ftype;
		if (file_exists($destination))
		{
			echo "<script type=\"text/javascript\">alert('同名文件已经存在了！')</script>";
			exit;
		}

		if(!move_uploaded_file ($filename, $destination))
		{
			echo "<script type=\"text/javascript\">alert('对不起，服务器空间已满，请下个整点再试！')</script>";
			exit;
		}

		$pinfo=pathinfo($destination);
		$fname=$pinfo[basename];


		echo "<script type=\"text/javascript\">parent.document.getElementById('t".$id."').style.background='url(./".$destination_folder.$fname.") center no-repeat';parent.document.getElementById('bgImgt".$id."').value='".$destination_folder.$fname."'</script>";
		//echo "<img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
		//echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
		//echo $destination_folder.$fname;
	}
?>