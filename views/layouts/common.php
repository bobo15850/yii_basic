<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>title</title>
	</head>
	<body>
		<h1>hello common</h1>
		<?php if(isset($this->blocks["block1"])):?>
			<?=$this->blocks["block1"];?>
		<?php else:?>
			<h1>未设置</h1>
		<?php endif;?>
		<?=$content?>
	</body>
</html>