<?php
	session_start();
	// 设置当前文档的格式
	header('Content-type: image/png');
	// 生成基础背景图（默认为黑色）
	$image = imagecreatetruecolor(100, 30);
	// 为图片分配颜色
	$bgcolor = imagecolorallocate($image, 255, 255, 255);
	// 为图片填充颜色
	imagefill($image, 0, 0, $bgcolor);

	// 生成随机数字
	/*for($i = 0; $i<4; $i++) {
		// 配置随机数字相关大小、颜色、字体、内容
		$fontsize = 16;
		$fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
		$fontcontent = rand(0, 9);
		$fontfamily = "font.ttf";
		// 设置每个数字的随机长宽
		$x = ($i*100/4);
		$y = rand(15,20);
		// 生成随机数字
		imagettftext($image, $fontsize, 0, $x, $y, $fontcolor, $fontfamily, $fontcontent);
	}
	*/
	$captch_code = '';

	// 生成4个随机字母和数字
	for ($i=0; $i < 4; $i++) { 
		$fontsize = 6;
		$fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
		$data = 'abcdefghijkmnopqrstuvwxy3456789';
		$fontcontent = substr($data, rand(0, strlen($data)),1);
		$captch_code .= $fontcontent;

		$x = ($i*100/4) +rand(5,10);
		$y = rand(5, 10);

		imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
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

