<?php
	session_start();
	
	$table = array(
		'pic1' => '狗',
		'pic2' => '猫',
		'pic3' => '鸟',
		'pic4' => '鱼'
	);

	$index = rand(1, 4);

	$value = $table['pic'.$index];
	$_SESSION['authcode'] = $value;

	$filename = dirname(__FILE__).'\\pic'.$index.'.png';
	$contents = file_get_contents($filename);

	header('Content-type: image/png');
	echo $contents;
?>