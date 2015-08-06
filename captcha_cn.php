<?php
	session_start();
	// 设置当前文档的格式
	header('Content-type: image/png');
	// 生成基础背景图（默认为黑色）
	$image = imagecreatetruecolor(200, 50);
	// 为图片分配颜色
	$bgcolor = imagecolorallocate($image, 255, 255, 255);
	// 为图片填充颜色
	imagefill($image, 0, 0, $bgcolor);

	$captch_code = '';

	// 设置自定义字体
	$fontface = 'font.ttf';
	// 自定义字库
	$strdb = array('慕','课','网','点','赞','不','错','哈','呵');
	// 生成4个随机汉字
	for ($i=0; $i < 4; $i++) { 
		$fontsize = 6;
		$fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));

		$j = mt_rand(0,count($strdb)-1);
		$cn = $strdb[$j];
		$captch_code .= $cn;

		imagettftext($image, mt_rand(20,24), mt_rand(-60,60),(40*$i+20),mt_rand(30,35),$fontcolor,$fontface,$cn);
	}

	$_SESSION['authcode'] = $captch_code;
	// 添加随机干扰点
	for ($i=0; $i<200; $i++) {
		// 设置干扰点的颜色
		$pointcolor = imagecolorallocate($image, rand(50,200), rand(50, 200), rand(50, 200));
		// 调用 imagesetpixel 函数生成干扰点
		imagesetpixel($image, rand(1,199), rand(1,199), $pointcolor);
	}

	// 添加干扰线
	for ($j=0; $j < 3; $j++) {
		// 设置线的颜色
		$linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
		// 生成干扰线
		imageline($image, rand(1, 99), rand(1, 29), rand(1, 99), rand(1, 29), $linecolor);
	}
	// 输出图片
	imagepng($image);

	// 销毁图片
	imagedestroy($image);

