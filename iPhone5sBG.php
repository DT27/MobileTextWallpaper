<?php
date_default_timezone_set ( 'PRC' );
/*
 * param $image 图象资源 param size 字体大小 param angle 字体输出角度 param showX 输出位置x坐标 param showY 输出位置y坐标 param font 字体文件位置 param content 要在图片里显示的内容
 */
class base {
	/**
	 * PHP图片缩放函数:实现等比例不失真缩放
	 *
	 * @param 图片对象 $im
	 * @param 定义生成图片的最大宽度 $maxwidth
	 * @param 生成图片的最大高度 $maxheight
	 */
	function resizeImg($im, $maxwidth, $maxheight) {
		$pic_width = imagesx ( $im );
		$pic_height = imagesy ( $im );

		if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
			if ($maxwidth && $pic_width > $maxwidth) {
				$widthratio = $maxwidth / $pic_width;
				$resizewidth_tag = true;
			}

			if ($maxheight && $pic_height > $maxheight) {
				$heightratio = $maxheight / $pic_height;
				$resizeheight_tag = true;
			}

			if ($resizewidth_tag && $resizeheight_tag) {
				if ($widthratio < $heightratio)
					$ratio = $widthratio;
				else
					$ratio = $heightratio;
			}

			if ($resizewidth_tag && ! $resizeheight_tag)
				$ratio = $widthratio;
			if ($resizeheight_tag && ! $resizewidth_tag)
				$ratio = $heightratio;

			$newwidth = $pic_width * $ratio;
			$newheight = $pic_height * $ratio;

			if (function_exists ( "imagecopyresampled" )) {
				$newim = imagecreatetruecolor ( $newwidth, $newheight );
				imagecopyresampled ( $newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height );
			} else {
				$newim = imagecreate ( $newwidth, $newheight );
				imagecopyresized ( $newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height );
			}
			return $newim;
		} else {
			return $im;
		}
	}

	/**
	 * 填充缩放图片
	 *
	 * @param 需要处理的图片 $src_img
	 * @param 目标宽度 $new_width
	 * @param 目标高度 $new_height
	 * @return resource
	 */
	function resizeImage($src_img, $new_width, $new_height) {
		$w = imagesx ( $src_img );
		$h = imagesy ( $src_img );
		$ratio_w = 1.0 * $new_width / $w;
		$ratio_h = 1.0 * $new_height / $h;
		$ratio = 1.0;
		// 生成的图像的高宽比原来的都小，或都大 ，原则是 取大比例放大，取大比例缩小（缩小的比例就比较小了）
		if (($ratio_w < 1 && $ratio_h < 1) || ($ratio_w > 1 && $ratio_h > 1)) {
			if ($ratio_w < $ratio_h) {
				$ratio = $ratio_h; // 情况一，宽度的比例比高度方向的小，按照高度的比例标准来裁剪或放大
			} else {
				$ratio = $ratio_w;
			}
			// 定义一个中间的临时图像，该图像的宽高比 正好满足目标要求
			$inter_w = ( int ) ($new_width / $ratio);
			$inter_h = ( int ) ($new_height / $ratio);
			$inter_img = imagecreatetruecolor ( $inter_w, $inter_h );
			imagecopy ( $inter_img, $src_img, 0, 0, 0, 0, $inter_w, $inter_h );
			// 生成一个以最大边长度为大小的是目标图像$ratio比例的临时图像
			// 定义一个新的图像
			$new_img = imagecreatetruecolor ( $new_width, $new_height );

			imagecopyresampled ( $new_img, $inter_img, 0, 0, 0, 0, $new_width, $new_height, $inter_w, $inter_h );
			return $new_img;
		} 		// end if 1
		  // 2 目标图像 的一个边大于原图，一个边小于原图 ，先放大平普图像，然后裁剪
		  // =if( ($ratio_w < 1 && $ratio_h > 1) || ($ratio_w >1 && $ratio_h <1) )
		else {
			$ratio = $ratio_h > $ratio_w ? $ratio_h : $ratio_w; // 取比例大的那个值
			                                                    // 定义一个中间的大图像，该图像的高或宽和目标图像相等，然后对原图放大
			$inter_w = ( int ) ($w * $ratio);
			$inter_h = ( int ) ($h * $ratio);
			$inter_img = imagecreatetruecolor ( $inter_w, $inter_h );
			// 将原图缩放比例后裁剪
			imagecopyresampled ( $inter_img, $src_img, 0, 0, 0, 0, $inter_w, $inter_h, $w, $h );
			// 定义一个新的图像
			$new_img = imagecreatetruecolor ( $new_width, $new_height );

			$sw = imagesx ( $inter_img );
			$sh = imagesy ( $inter_img );
			if ($new_width < $sw)
				imagecopy ( $new_img, $inter_img, 0, 0, ($sw - $new_width) / 2, 0, $new_width, $new_height );
			else
				imagecopy ( $new_img, $inter_img, 0, 0, 0, 0, $new_width, $new_height );
			return $new_img;
		} // if3
	} // end function
	/**
	 * 获取文件列表
	 *
	 * @param mixed $dir
	 */
	function getFiles() {
		$fileArray [] = NULL;
		if (false != ($handle = opendir ( 'temp/' ))) {
			$i = 0;
			while ( false !== ($file = readdir ( $handle )) ) {
				// 去掉"“.”、“..”以及带“check”后缀的文件
				if ($file != "." && $file != ".." && ! strpos ( $file, "check" ) && strpos ( $file, "." )) {
					$fileArray [$i] = $file;
					if ($i == 100) {
						break;
					}
					$i ++;
				}
			}
			// 关闭句柄
			closedir ( $handle );
		}
		return $fileArray;
	}
	function delImgs($ymd, $h) {
		$files = $this->getFiles ();
		if ($h < 11)
			$fname = ( int ) ($ymd . '0' . ($h - 1));
		else
			$fname = ( int ) ($ymd . ($h - 1));

		if ($h == 0) {
			$fname = ( int ) (($ymd - 1) . '23');
		}

		foreach ( $files as $file ) {
			$a1 = substr ( $file, 0, 8 );
			$a2 = substr ( $file, 9, 2 );
			$a = $a1 . $a2;
			if ($a < $fname) {
				$this->delImg ( './temp/' . $file );
			}
		}
		if ($h == 1) {
			if (file_exists ( 'temp/' . $fname . '.check' )) {
				rename ( 'temp/' . $fname . '.check', 'temp/' . $ymd . '00.check' ); // 把原文件重新命名
			} else {
				$fp = fopen ( 'temp/' . $ymd . '00.check', "w+" ); // 打开文件指针，创建文件
				fclose ( $fp ); // 关闭指针
			}
		} else {
			if (file_exists ( 'temp/' . ($fname < 11 ? $ymd . '0' . ($h - 1) : $fname - 1) . '.check' )) {
				rename ( 'temp/' . ($fname < 11 ? $ymd . '0' . ($h - 1) : $fname - 1) . '.check', 'temp/' . $fname . '.check' ); // 把原文件重新命名
			} else {
				$fp = fopen ( 'temp/' . $fname . '.check', "w+" ); // 打开文件指针，创建文件
				fclose ( $fp ); // 关闭指针
			}
		}
	}
	function createText($instring) {
		$outstring = "";
		$max = strlen ( $instring );
		for($i = 0; $i < $max; $i ++) {
			$h = ord ( $instring [$i] );
			if ($h >= 160 && $i < $max - 1) {
				$outstring .= substr ( $instring, $i, 2 );
				$i ++;
			} else {
				$outstring .= $instring [$i];
			}
		}
		return $outstring;
	}
	function saveImg($image) {
		date_default_timezone_set ( 'PRC' );
		$FileID = date ( "Ymd_His" ) . '_' . rand ( 1000, 9999 );
		$FileName = 'temp/' . $FileID . '.png';
		imagepng ( $image, $FileName );
		ImageDestroy ( $image );
		return $FileName;
	}
	function delImg($delfile) {
		$name = '../5s/' . $delfile;
		if (file_exists ( $name )) {
			unlink ( $name );
		}
	}
	/**
	 * 16进制颜色转换为RGB色值
	 *
	 * @method hex2rgb
	 */
	function hex2rgb($hexColor) {
		$color = str_replace ( '#', '', $hexColor );
		if (strlen ( $color ) > 3) {
			$rgb = array (
					'r' => hexdec ( substr ( $color, 0, 2 ) ),
					'g' => hexdec ( substr ( $color, 2, 2 ) ),
					'b' => hexdec ( substr ( $color, 4, 2 ) )
			);
		} else {
			$color = str_replace ( '#', '', $hexColor );
			$r = substr ( $color, 0, 1 ) . substr ( $color, 0, 1 );
			$g = substr ( $color, 1, 1 ) . substr ( $color, 1, 1 );
			$b = substr ( $color, 2, 1 ) . substr ( $color, 2, 1 );
			$rgb = array (
					'r' => hexdec ( $r ),
					'g' => hexdec ( $g ),
					'b' => hexdec ( $b )
			);
		}
		return $rgb;
	}
}
class showChinaText {
	var $text; // = '你他妈吃天胆了？';
	var $font = 'fonts/wryh.ttf'; // 如果没有要自己加载到相应的目录下（本地www）
	var $bgpic;
	var $logo;
	var $finger;
	var $type;
	var $bgImg;
	var $colorT1;
	var $colorTText;
	var $showY = 638; // +128
	var $text0; // = '敢动老子的手机！';
	var $showY0 = 708;
	var $text3;
	var $showY3 = 773;
	var $text1; // = '不要问我密码';
	var $showY1 = 1005;
	var $text2; // = '我这是5S，指纹解锁';
	var $showY2 = 1060;
	function __construct($text, $text0, $text3, $text1, $text2, $type, $finger, $logo, $colorT1, $colorTText, $bgImg) {
		if (isset ( $bgImg )) {
			$this->bgImg = $bgImg;
		}
		if (isset ( $text )) {
			$this->text = $text;
		}
		if (isset ( $text0 )) {
			$this->text0 = $text0;
		}

		if (isset ( $text3 )) {
			$this->text3 = $text3;
		}
		if (isset ( $text1 )) {
			$this->text1 = $text1;
		}
		if (isset ( $text2 )) {
			$this->text2 = $text2;
		}
		if (isset ( $type )) {
			$this->type = $type;
			if ($type == 10)
				$this->colorT1 = $colorT1;
		}
		if (isset ( $finger ))
			$this->finger = $finger;
		if (isset ( $logo ))
			$this->logo = $logo;

		if (isset ( $colorTText ) && $colorTText != '') {
			$this->colorTText = $colorTText;
		}
	}
	function show() {
		// 输出头内容
		// Header ( "Content-type: image/png" );
		// 建立图象
		// $image = imagecreate(400,300);
		$base = new base ();
		// 建立图象
		switch ($this->type) {
			case 10 :
				$image = imagecreatetruecolor ( 744, 1392 );
				// 背景颜色
				$colors = $base->hex2rgb ( $this->colorT1 );
				$bgColor = ImageColorAllocate ( $image, $colors ['r'], $colors ['g'], $colors ['b'] );
				imagefilledrectangle ( $image, 0, 0, 744, 1392, $bgColor ); // 图片着色
				break;
			default :
				$filename = $this->bgImg;
				$file = fopen ( $filename, "rb" );
				$bin = fread ( $file, 2 ); // 只读2字节
				fclose ( $file );
				$strInfo = @unpack ( "C2chars", $bin );
				$typeCode = intval ( $strInfo ['chars1'] . $strInfo ['chars2'] );
				switch ($typeCode) {
					case 255216 :
						$image = imagecreatefromjpeg ( $this->bgImg );
						break;
					case 13780 :
						$image = imagecreatefrompng ( $this->bgImg );
						break;
					default :
						$image = imagecreatefrompng ( $this->bgImg );
						break;
				}
				break;
		}
		$image = $base->resizeImage ( $image, 744, 1392 );
		$pic_width = imagesx ( $image );
		$pic_height = imagesy ( $image );
		// 定义颜色
		$textColors = $base->hex2rgb ( $this->colorTText );
		$textColor = ImageColorAllocate ( $image, $textColors ['r'], $textColors ['g'], $textColors ['b'] );
		// PNG水印图
		if ($this->logo != 0) {
			// $imgSrcLogo;
			switch ($this->logo) {
				case 1 :
					$imgSrcLogo = "img/iphone5s_title.png";
					break;
				case 2 :
					$imgSrcLogo = "img/iphone5s_title_white.png";
					break;
				case 3 :
					$imgSrcLogo = "img/apple_logo.png";
					break;
				case 4 :
					$imgSrcLogo = "img/apple_logo_white.png";
					break;
			}
			$srcimLogo = imagecreatefrompng ( $imgSrcLogo );
			$srcImgLogo_w = imagesx ( $srcimLogo );
			// if($pic_width!=744||$pic_height!=1392){
			// $dst_x=195-52;
			// $dst_y=440-128;
			// }else{
			$dst_x = 195;
			$dst_y = 440;
			// }
			imagecopy ( $image, $srcimLogo, ($pic_width - $srcImgLogo_w) / 2, $dst_y, 0, 0, $srcImgLogo_w, imagesy ( $srcimLogo ) );
		}
		if ($this->finger != 0) {
			switch ($this->finger) {
				case 1 :
					$imgSrcFinger = "img/finger.png";
					break;
				case 2 :
					$imgSrcFinger = "img/apple.png";
					break;
				case 3 :
					$imgSrcFinger = "img/apple_white.png";
					break;
			}
			$srcimFinger = imagecreatefrompng ( $imgSrcFinger );
			$srcImgFinger_w = imagesx ( $srcimFinger );

			$dst_x = 310;
			$dst_y = 780;

			imagecopy ( $image, $srcimFinger, ($pic_width - $srcImgFinger_w) / 2, $dst_y, 0, 0, $srcImgFinger_w, imagesy ( $srcimFinger ) );
		}
		// 显示文字
		$txt = $base->createText ( $this->text );
		$txt0 = $base->createText ( $this->text0 );
		$txt3 = $base->createText ( $this->text3 );
		$txt1 = $base->createText ( $this->text1 );
		$txt2 = $base->createText ( $this->text2 );
		// 写入文字
		$fbox = imagettfbbox ( 36, 0, $this->font, $txt ); // (744-$fbox[2])/2
		imagettftext ( $image, 36, 0, ($pic_width - $fbox [2]) / 2, $this->showY, $textColor, $this->font, $txt );
		$fbox = imagettfbbox ( 36, 0, $this->font, $txt0 );
		imagettftext ( $image, 36, 0, ($pic_width - $fbox [2]) / 2, $this->showY0, $textColor, $this->font, $txt0 );
		$fbox = imagettfbbox ( 30, 0, $this->font, $txt1 );
		imagettftext ( $image, 30, 0, ($pic_width - $fbox [2]) / 2, $this->showY1, $textColor, $this->font, $txt1 );
		$fbox = imagettfbbox ( 30, 0, $this->font, $txt2 );
		imagettftext ( $image, 30, 0, ($pic_width - $fbox [2]) / 2, $this->showY2, $textColor, $this->font, $txt2 );
		$fbox = imagettfbbox ( 36, 0, $this->font, $txt3 );
		imagettftext ( $image, 36, 0, ($pic_width - $fbox [2]) / 2, $this->showY3, $textColor, $this->font, $txt3 );
		// ImageString($image,5,50,10,$txt,$white);
		// 显示图形
		echo $base->saveImg ( $image );
		// ImageDestroy ( $image );
		// ImageDestroy ( $srcim );
	}
}
/**
 * 样式二六行 两名字loveName1
 */
class showLoveText {
	var $font = 'fonts/jybxs.ttf';
	var $fontName = 'fonts/jybxs.ttf';
	var $fonten = 'fonts/ElegantScript.ttf';
	var $nameSize = 38;
	var $color = 1;
	var $colorT3 = "fff";
	var $colorT3Text = "000";
	var $bgImgt3 = "";

	// +52
	// +128
	var $text;
	var $showX = 142;
	var $showY = 618;
	var $text0;
	var $showX0 = 157;
	var $showY0 = 668;
	var $text1;
	var $showX1 = 142;
	var $showY1 = 758;
	var $text2;
	var $showX2 = 157;
	var $showY2 = 808;
	var $text3;
	var $showX3 = 142;
	var $showY3 = 798;
	var $text4;
	var $showX4 = 157;
	var $showY4 = 848;
	var $loveName1;
	var $showXName1 = 377;
	var $showYName1 = 978;
	var $loveName2;
	var $showXName2 = 549;
	var $showYName2 = 978;
	function __construct($text, $text0, $text1, $text2, $text3, $text4, $loveName1, $loveName2, $colorT3, $colorT3Text, $bgImgt3, $fontName) {
		$loveName1 = trim ( $loveName1 );
		$loveName2 = trim ( $loveName2 );

		if (isset ( $bgImgt3 )) {
			$this->bgImgt3 = $bgImgt3;
		}
		if (isset ( $fontName )) {
			if ($fontName==1) {
				$this->fontName = 'fonts/wryh.ttf';
				$this->nameSize = 30;
			}
		}
		// echo strlen($text3);
		if (isset ( $colorT3 )) {
			$this->colorT3 = $colorT3;
		}
		if (isset ( $colorT3Text ) && $colorT3Text != '') {
			$this->colorT3Text = $colorT3Text;
		}
		if (isset ( $text )) {
			$this->text = $text;
		}
		if (isset ( $text0 )) {
			$this->text0 = $text0;
		}

		if (isset ( $text1 )) {
			$this->text1 = $text1;
		}
		if (isset ( $text2 )) {
			$this->text2 = $text2;
		}
		if ((isset ( $text3 ) && $text3 != '') || (isset ( $text4 ) && $text4 != '')) {
			$this->text3 = $text3;
			$this->text4 = $text4;
			$this->showY = $this->showY - 100;
			$this->showY0 = $this->showY0 - 100;
			$this->showY1 = $this->showY1 - 100;
			$this->showY2 = $this->showY2 - 100;
		}
		if (isset ( $loveName1 ) && $loveName1 != '') {
			$this->loveName1 = $loveName1;
			if (isset ( $loveName2 ) && $loveName2 != '') {
				if (strlen ( $loveName1 ) == 9) {
					$this->showXName1 = 377;
				}
				if (strlen ( $loveName1 ) <= 7) {
					$this->showXName1 = 377 + 48;
				}
				if (strlen ( $loveName1 ) <= 4) {
					$this->showXName1 = 377 + 48 + 24;
				}
			} else {
				if (strlen ( $loveName1 ) == 9) {
					$this->showXName1 = 437 + 24;
					$this->showY3 = 1000;
				}
				if (strlen ( $loveName1 ) <= 7) {
					$this->showXName1 = 437 + 48;
					$this->showY3 = 1000;
				}
				if (strlen ( $loveName1 ) <= 4) {
					$this->showXName1 = 437 + 72;
					$this->showY3 = 1000;
				}
			}
		}
		if (isset ( $loveName2 )) {
			$this->loveName2 = $loveName2;
			if (! isset ( $loveName1 ) || $loveName1 == '') {
				if (strlen ( $loveName2 ) == 9) {
					$this->showXName2 = 437 + 24;
					$this->showYName2 = 1000;
				}
				if (strlen ( $loveName2 ) <= 7) {
					$this->showXName2 = 437 + 48;
					$this->showYName2 = 1000;
				}
				if (strlen ( $loveName2 ) <= 4) {
					$this->showXName2 = 437 + 72;
					$this->showYName2 = 1000;
				}
			} else {
				if (strlen ( $loveName2 ) == 9) {
					$this->showXName2 = 537 + 12;
				}
				if (strlen ( $loveName2 ) <= 4) {
					$this->showXName2 = 437 + 72 + 65;
				}
			}
		}
	}
	function show() {
		// 输出头内容
		// Header ( "Content-type: image/png" );
		$base = new base ();
		// 建立图象
		if (! isset ( $this->bgImgt3 ) || $this->bgImgt3 == "") {
			$image = imagecreatetruecolor ( 744, 1392 );
			// 背景颜色
			$colors = $base->hex2rgb ( $this->colorT3 );
			$bgColor = ImageColorAllocate ( $image, $colors ['r'], $colors ['g'], $colors ['b'] );
			imagefilledrectangle ( $image, 0, 0, 744, 1392, $bgColor ); // 图片着色
		} else {
			$filename = $this->bgImgt3;
			$file = fopen ( $filename, "rb" );
			$bin = fread ( $file, 2 ); // 只读2字节
			fclose ( $file );
			$strInfo = @unpack ( "C2chars", $bin );
			$typeCode = intval ( $strInfo ['chars1'] . $strInfo ['chars2'] );
			switch ($typeCode) {
				case 255216 :
					$image = imagecreatefromjpeg ( $filename );
					break;
				case 13780 :
					$image = imagecreatefrompng ( $filename );
					break;
			}
		}

		$pic_width = imagesx ( $image );
		$pic_height = imagesy ( $image );
		if ($pic_width != 744 || $pic_height != 1392) {
			$image = $base->resizeImage ( $image, 744, 1392 );
			$pic_width = imagesx ( $image );
			$pic_height = imagesy ( $image );
		}
		// $image = imagecreatefromjpeg ( $this->bgpic ); //这里的图片，换成你的图片路径
		// 定义颜色
		$red = ImageColorAllocate ( $image, 255, 0, 0 );
		$white = ImageColorAllocate ( $image, 255, 255, 255 );
		$black = ImageColorAllocate ( $image, 0, 0, 0 );
		$textColors = $base->hex2rgb ( $this->colorT3Text );
		$textColor = ImageColorAllocate ( $image, $textColors ['r'], $textColors ['g'], $textColors ['b'] );

		// 填充颜色
		// ImageFilledRectangle($image,0,0,200,200,$red);
		// PNG水印图
		$imgSrc = "img/heart.png";
		$srcInfo = getimagesize ( $imgSrc );
		$srcImg_w = $srcInfo [0];
		$srcImg_h = $srcInfo [1];
		$srcim = imagecreatefrompng ( $imgSrc );
		// imagecolortransparent($imgSrc,$white); //imagecolortransparent() 设置具体某种颜色为透明色，若注释

		$dst_x = 408;
		$dst_y = 886;
		imagecopy ( $image, $srcim, $dst_x, $dst_y, 0, 0, $srcImg_w, $srcImg_h );
		// 显示文字
		$txt = $base->createText ( $this->text );
		$txt0 = $base->createText ( $this->text0 );
		$txt1 = $base->createText ( $this->text1 );
		$txt2 = $base->createText ( $this->text2 );
		$txt3 = $base->createText ( $this->text3 );
		$txt4 = $base->createText ( $this->text4 );
		$loveName1 = $base->createText ( $this->loveName1 );
		$loveName2 = $base->createText ( $this->loveName2 );

		// 写入文字
		imagettftext ( $image, 38, 0, $this->showX, $this->showY, $textColor, $this->font, $txt );
		imagettftext ( $image, 36, 0, $this->showX0, $this->showY0, $textColor, $this->fonten, $txt0 );
		imagettftext ( $image, 38, 0, $this->showX1, $this->showY1, $textColor, $this->font, $txt1 );
		imagettftext ( $image, 36, 0, $this->showX2, $this->showY2, $textColor, $this->fonten, $txt2 );
		imagettftext ( $image, 38, 0, $this->showX3, $this->showY3, $textColor, $this->font, $txt3 );
		imagettftext ( $image, 36, 0, $this->showX4, $this->showY4, $textColor, $this->fonten, $txt4 );

		$fbox = imagettfbbox ( $this->nameSize, 0, $this->fontName, $loveName1 ); // (744-$fbox[2])/2
		imagettftext ( $image, $this->nameSize, 0, 744-215-$fbox[2], $this->showYName1, $textColor, $this->fontName, $loveName1 );
		imagettftext ( $image, $this->nameSize, 0, $this->showXName2, $this->showYName2, $textColor, $this->fontName, $loveName2 );

		echo $base->saveImg ( $image );
		// ImageDestroy ( $image );
		ImageDestroy ( $srcim );
	}
}
class showText {
	var $text;
	var $size = 48;
	var $font = 'fonts/jdchj.ttf';
	var $fontshouxie = 'fonts/jybxs.ttf';
	var $fontName = 'fonts/jdchj.ttf';
	var $font6 = 'fonts/jdzy.ttf';
	var $bgpic = 'img/4.jpg';
	var $color = 1;
	var $type;
	var $sex;
	var $showX = 192; // +52
	var $showY = 848; // +128
	var $text0;
	var $showX0 = 140;
	var $showY0 = 958;
	function __construct($text, $text0, $type, $sex) {
		if (isset ( $sex )) {
			$this->sex = $sex;
		}
		$this->type = $type;
		switch ($type) {
			case 4 :
				if (isset ( $text )) {
					$this->text = $text;
					switch (strlen ( $text )) {
						case 6 : // 3*2
							$this->showX = (744 - (strlen ( $text ) / 3 * 50)) / 2 - 10;
							$this->showY = 880;
							break;
						case 9 : // 3*3
							$this->showX = (744 - (strlen ( $text ) / 3 * 50)) / 2;
							$this->showY = 860;
							break;
						case 12 : // 3*4
							$this->showX = (744 - (strlen ( $text ) / 3 * 50)) / 2 - 10;
							$this->showY = 850;
							break;
						case 15 : // 3*5
							$this->showX = (744 - (strlen ( $text ) / 3 * 50)) / 2 - 25;
							$this->showY = 840;
							break;
					}
				}
				if (isset ( $text0 )) {
					$this->text0 = $text0;
					$this->showY0 = 958;
					if (preg_match ( "/[\x7f-\xff]/", $text0 )) {
						switch (strlen ( $text0 )) {
							case 6 : // 3*2
								$this->showX0 = (744 - (strlen ( $text0 ) / 3 * 50)) / 2 - 50;
								break;
							case 9 : // 3*3
								$this->showX0 = (744 - (strlen ( $text0 ) / 3 * 50)) / 2 - 50;
								break;
							case 12 : // 3*4
								$this->showX0 = (744 - (strlen ( $text0 ) / 3 * 50)) / 2 - 50;
								break;
							case 15 : // 3*5
								$this->showX0 = (744 - (strlen ( $text0 ) / 3 * 50)) / 2 - 70;
								break;
							case 27 : // 3*9
								$this->showY0 = 958 - 15;
								$this->showX0 = (744 - (strlen ( $text0 ) / 3 * 50)) / 2 - 10;
								$this->size = 34;
								break;
						}
					} else {
						$this->showX0 = (744 - (strlen ( $text0 ) / 3 * 50)) / 2 - 100;
						$this->font = 'fonts/wryh.ttf';
						$this->size = 36;
					}
				}
				break;
			case 5 :
				if (isset ( $text )) {
					$this->text = $text;
					switch (strlen ( $text )) {
						case 2 :
						case 3 :
						case 4 :
							$this->showX = 240 + 24;
							break;
						case 5 :
						case 6 : // 3*2
						case 8 :
							$this->showX = 240;
							break;
						case 7 :
						case 9 :
						case 10 :
							$this->showX = 223;
							break;
						default :
							$this->showX = 223 - 12;
							break;
					}
					$this->showY = 940;
				}
				if (isset ( $text0 )) {
					$this->text0 = $text0;
					switch (strlen ( $text0 )) {
						case 2 :
						case 3 :
						case 4 :
							$this->showX0 = 462 + 24;
							break;
						case 5 :
						case 6 : // 3*2
						case 7 :
							$this->showX0 = 462;
							break;
						case 8 :
						case 9 : // 3*3
						case 10 :
							$this->showX0 = 459 - 11;
							break;
						default :
							$this->showX = 459 - 40;
							break;
					}
					$this->showY0 = 940;
				}
				break;
			case 6 :
				if (isset ( $text )) {
					$this->text = $text;
				}
				if (isset ( $sex )) {
					$this->sex = $sex;
					$this->bgpic = "img/6" . $sex . ".jpg";
					$this->showY = 805;
				}
				break;
			case 7 :
				if (isset ( $text )) {
					$this->text = $text;
				}
				if (isset ( $text0 )) {
					$this->text0 = $text0;
				}
				break;
		}
	}
	function show() {
		// Header ( "Content-type: image/png" );
		$base = new base ();

		switch ($this->type) {
			case 4 :
				$image = imagecreatefromjpeg ( $this->bgpic );
				$red = ImageColorAllocate ( $image, 255, 0, 0 );
				$white = ImageColorAllocate ( $image, 255, 255, 255 );
				$black = ImageColorAllocate ( $image, 0, 0, 0 );
				$txt = $base->createText ( $this->text );
				$txt0 = $base->createText ( $this->text0 );
				imagettftext ( $image, 48, - 24, $this->showX, $this->showY, $white, $this->font, $txt );
				imagettftext ( $image, $this->size, - 24, $this->showX0, $this->showY0, $white, $this->font, $txt0 );
				echo $base->saveImg ( $image );
				break;
			case 5 :
				// 建立图象
				$image = imagecreatetruecolor ( 744, 1392 );
				// $image = imagecreatefromjpeg ( $this->bgpic ); //这里的图片，换成你的图片路径
				// 定义颜色
				$boy = ImageColorAllocate ( $image, 33, 167, 221 );
				$girl = ImageColorAllocate ( $image, 226, 81, 114 );
				// 背景颜色
				$this->sex == 1 ? $bgColor = ImageColorAllocate ( $image, 163, 201, 230 ) : $bgColor = ImageColorAllocate ( $image, 255, 210, 195 );

				imagefilledrectangle ( $image, 0, 0, 744, 1392, $bgColor ); // 图片着色
				                                                            // PNG水印图
				$imgSrc = "img/lovers.png";
				$srcInfo = getimagesize ( $imgSrc );
				$srcImg_w = $srcInfo [0];
				$srcImg_h = $srcInfo [1];
				$srcim = imagecreatefrompng ( $imgSrc );
				// imagecolortransparent($imgSrc,$white); //imagecolortransparent() 设置具体某种颜色为透明色，若注释

				$dst_x = 137;
				$dst_y = 491;
				imagecopy ( $image, $srcim, $dst_x, $dst_y, 0, 0, $srcImg_w, $srcImg_h );

				// PNG水印图
				$imgSrc = "img/hearts.png";
				$srcInfo = getimagesize ( $imgSrc );
				$srcImg_w = $srcInfo [0];
				$srcImg_h = $srcInfo [1];
				$srcim = imagecreatefrompng ( $imgSrc );
				// imagecolortransparent($imgSrc,$white); //imagecolortransparent() 设置具体某种颜色为透明色，若注释

				$dst_x = 326;
				$dst_y = 831;
				imagecopy ( $image, $srcim, $dst_x, $dst_y, 0, 0, $srcImg_w, $srcImg_h );
				$txt = $base->createText ( $this->text );
				$txt0 = $base->createText ( $this->text0 );
				imagettftext ( $image, 28, 0, $this->showX, $this->showY, $girl, $this->fontName, $txt );
				imagettftext ( $image, 28, 0, $this->showX0, $this->showY0, $boy, $this->fontName, $txt0 );
				echo $base->saveImg ( $image );
				break;
			case 6 :
				$image = imagecreatefromjpeg ( $this->bgpic );
				$white = ImageColorAllocate ( $image, 255, 255, 255 );
				$txt = $base->createText ( $this->text );
				$fbox = imagettfbbox ( $this->size, 0, $this->font6, $txt ); // (744-$fbox[2])/2
				if ($fbox [2] > 360)
					$this->size = 36;
				$fbox = imagettfbbox ( $this->size, 0, $this->font6, $txt ); // (744-$fbox[2])/2
				switch ($this->sex) {
					case 0 :
						imagettftext ( $image, $this->size, 0, 300, $this->showY, $white, $this->font6, $txt );
						break;
					case 1 :
						imagettftext ( $image, $this->size, 0, (500 - $fbox [2]) / 2 + 52, $this->showY, $white, $this->font6, $txt );
						break;
					case 2 :
						imagettftext ( $image, $this->size, 0, (744 - $fbox [2]) / 2, $this->showY, $white, $this->font6, $txt );
						break;
				}

				echo $base->saveImg ( $image );
				break;
			case 7 :
				$image = imagecreatetruecolor ( 744, 1392 );
				$black = ImageColorAllocate ( $image, 0, 0, 0 );
				$bgColor = ImageColorAllocate ( $image, 240, 236, 225 );
				imagefilledrectangle ( $image, 0, 0, 744, 1392, $bgColor ); // 图片着色
				// PNG水印图
				$imgSrc = "img/7logo.png";
				$srcInfo = getimagesize ( $imgSrc );
				$srcImg_w = $srcInfo [0];
				$srcImg_h = $srcInfo [1];
				$srcim = imagecreatefrompng ( $imgSrc );
				//$dst_x = 74;
				$dst_y = 600;
				imagecopy ( $image, $srcim, (744-$srcImg_w)/2, $dst_y, 0, 0, $srcImg_w, $srcImg_h );

				$txt = $base->createText ( $this->text );
				$txt0 = $base->createText ( $this->text0 );
				imagettftext ( $image, 40, 0, 120, 805, $black, $this->fontshouxie, $txt );
				imagettftext ( $image, 40, 0, 135, 900, $black, $this->fontshouxie, $txt0 );

				echo $base->saveImg ( $image );
				break;
		}
	}
}
?>
<?php

$type = 1;
$type = $_REQUEST ["type"];
$base = new base ();

switch ($type) {
	case 999 :
		$filename = "issues.txt"; // 定义操作文件
		$fcontent = file ( $filename ); // file()把整个文件读入一个数组中
		$fp = fopen ( "$filename", "a" );
		$str = $_REQUEST ["IP"] . ' ' . $_REQUEST ["Address"] . ' ' . $_REQUEST ["title"] . ' ' . $_REQUEST ["content"] . "\r\n\r\n";
		fwrite ( $fp, $str );
		fclose ( $fp ); // 关闭指针
		break;
	case 0 :
		$base->delImg ( $_REQUEST ["filename"] );
		break;
	case 3 :
		$s = new showLoveText ( $_REQUEST ["lovetext"], $_REQUEST ["lovetext0"], $_REQUEST ["lovetext1"], $_REQUEST ["lovetext2"], $_REQUEST ["lovetext3"], $_REQUEST ["lovetext4"], $_REQUEST ["loveName1"], $_REQUEST ["loveName2"], $_REQUEST ["colorT3"], $_REQUEST ["colorT3Text"], $_REQUEST ["bgImgt3"], $_REQUEST ["font"] );
		$s->show ();
		break;
	case 4 :
		$s = new showText ( $_REQUEST ["t41"], $_REQUEST ["t42"], 4, null );
		$s->show ();
		break;
	case 5 :
		$s = new showText ( $_REQUEST ["t51"], $_REQUEST ["t52"], 5, $_REQUEST ["sex"] );
		$s->show ();
		break;
	case 6 :
		$s = new showText ( $_REQUEST ["t6"], null, 6, $_REQUEST ["sex6"] );
		$s->show ();
		break;
	case 7 :
		$s = new showText ( $_REQUEST ["t71"], $_REQUEST ["t72"], 7, null );
		$s->show ();
		break;
	case 1 :
	case 10 :
	case 11 :
	case 12 :
	case 13 :
	case 14 :
		$s = new showChinaText ( $_REQUEST ["text"], $_REQUEST ["text0"], $_REQUEST ["text3"], $_REQUEST ["text1"], $_REQUEST ["text2"], $type, $_REQUEST ["finger"], $_REQUEST ["logo"], $_REQUEST ["colorT1"], $_REQUEST ["colorTText"], $_REQUEST ["bgImgt1"] );
		$s->show ();
		break;
	default :
		$s = new showChinaText ( $_REQUEST ["text"], $_REQUEST ["text0"], $_REQUEST ["text3"], $_REQUEST ["text1"], $_REQUEST ["text2"], $type, $_REQUEST ["finger"], $_REQUEST ["logo"], $_REQUEST ["colorT1"], $_REQUEST ["colorTText"], $_REQUEST ["bgImgt1"] );
		$s->show ();
		break;
}

if ($type != 0) {
	$ymd = ( int ) date ( "Ymd" );
	$h = date ( "H" ); // 03
	if ($h == '00') {
		if (! file_exists ( 'temp/' . ($ymd - 1) . '23.check' )) {
			$base->delImgs ( $ymd, $h );
		}
	} else {
		if (! file_exists ( 'temp/' . ($ymd - 1) . $h . '.check' )) {
			$base->delImgs ( $ymd, $h );
		}
	}
}
?>