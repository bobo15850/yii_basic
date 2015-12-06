<?php

	$_fp = @fopen('data.xml','w');
	if(!$_fp){
		exit('系统错误，文件不存在！');
	}
	flock($_fp,LOCK_EX);
	$_string = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\t";
	fwrite($_fp, $_string,strlen($_string));
	$_string = "<data>\r\t";
	fwrite($_fp, $_string,strlen($_string));

	for($i=0;$i<10;$i++){
		$userid = $i;
		$height = rand(175,185);
		for($j=0;$j<500;$j++){
			$str = -$j." days";
			$date = date('Y-m-d',strtotime($str));
			$highblood = rand(125, 135);
			$lowblood = rand(75,90);
			$weight = rand(70,75);
			$heartbeat = rand(65,75);
			$sleep = rand(5,9);
			$step = rand(5000,18000);

			$_string = "\t<item>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<userid>".$userid."</userid>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<date>".$date."</date>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<height>".$height."</height>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<weight>".$weight."</weight>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<highblood>".$highblood."</highblood>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<lowblood>".$lowblood."</lowblood>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<heartbeat>".$heartbeat."</heartbeat>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<sleep>".$sleep."</sleep>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t\t<step>".$step."</step>\r\t";
			fwrite($_fp, $_string,strlen($_string));
			$_string = "\t</item>\r\t";
			fwrite($_fp, $_string,strlen($_string));			
		}
	}

	$_string = "</data>";
	fwrite($_fp, $_string,strlen($_string));
	flock($_fp,LOCK_UN);
	fclose($_fp);
	echo "over";
?>