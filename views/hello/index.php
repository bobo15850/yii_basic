<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<h1><?=$view_hello_str;?></h1><!--不安全-->

<!--安全的方式如下-->
<h1><?=Html::encode($view_hello_str);?></h1><!--把js代码当作文本-->
<h1><?=Html::encode($view_hello_arr[1]);?></h1>

<h1><?=HtmlPurifier::process($view_hello_str);?></h1><!--完全去除javascript代码-->