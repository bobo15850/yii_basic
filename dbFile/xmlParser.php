<?php
   	class MyDB extends SQLite3
   	{
      	function __construct()
      	{
        	 $this->open('yii.db');
      	}
   	}
   	$db = new MyDB();
   	if(!$db){
    	echo $db->lastErrorMsg();
   	} else {
    	echo "Opened database successfully\n";
   	}
   	$sql="";
	$doc = new DOMDocument(); 
	$doc->load('data.xml'); //读取xml文件
	$items = $doc->getElementsByTagName('item');
	foreach ($items as $item) {
		$userid = $item->getElementsByTagName('userid')->item(0)->nodeValue;
		$date = $item->getElementsByTagName('date')->item(0)->nodeValue;
		$height = $item->getElementsByTagName('height')->item(0)->nodeValue;
		$weight = $item->getElementsByTagName('weight')->item(0)->nodeValue;
		$highblood = $item->getElementsByTagName('highblood')->item(0)->nodeValue;
		$lowblood = $item->getElementsByTagName('lowblood')->item(0)->nodeValue;
		$heartbeat = $item->getElementsByTagName('heartbeat')->item(0)->nodeValue;
		$sleep = $item->getElementsByTagName('sleep')->item(0)->nodeValue;
		$step = $item->getElementsByTagName('step')->item(0)->nodeValue;
		$sql =$sql."insert into healthState (userid,date,height,weight,highblood,lowblood,heartbeat,sleep,step) 
		values (".$userid.",'".$date."',".$height.",".$weight.",".
			$highblood.",".$lowblood.",".$heartbeat.",".$sleep.",".$step.");";
	}  
   	$ret = $db->exec($sql);
   	if(!$ret){
      	echo $db->lastErrorMsg();
   	} else {
    	echo "Records created successfully\n";
   	}
   	$db->close();
?>