<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>确认验证</title>
</head>
<body>
<?php

	if (isset($_REQUEST['authcode'])) {
		session_start();

		if (strtolower($_REQUEST['authcode']) == $_SESSION['authcode']) {
			echo "<div>输入正确！</div>";
		} else {
			echo "<div>输入错误！</div>";
		}
		exit();
	}

?>
	<form action="form.php" method="post">
		<p>验证码图片：
			<img id="captcha_img" src="captcha_img.php?r=<?php echo rand();?>"; width="200" height="200">
			<a href="javascript:;" onclick="
			document.getElementById('captcha_img').src='captcha_img.php?r='+Math.random()">换一个？</a>
		</p>
		<p>请输入图片中的内容：<input type="text" name="authcode" value=""></p>
		<p><input type="submit" value="提交" style="padding: 6px 20px;"></p>
	</form>
</body>
</html>