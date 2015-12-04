<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);//注册css和js文件，与后面的$this->head()配合使用
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?><!--与 “yii 提交表单报400错误，提示 “您提交的数据无法验证”,问题处理” 有关-->
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?><!--表示css和js的引用代码在这里显示-->
</head>

<body>
<?php $this->beginBody() ?>
<div class="frame">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Ding Ding</a>
            </div><!--主页按钮-->

            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php?r=activity/index">活动广场</a></li>
                    <li><a href="#">朋友圈</a></li>
                    <li><a href="#">博文分享</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    $session=yii::$app->session;
                    if (!isset($session['user'])) {
                        echo "<li><a href='index.php?r=account/login'>登陆</a></li>";
                    }//未登录状态
                    else {
                        echo "<li><a href='index.php?r=account/index'>";
                        $user=$session['user'];
                        echo $user['username'];
                        echo "</a></li>";
                        echo "<li><a href='index.php?r=account/log-out'>退出</a></li>";
                    }//登陆之后状态
                    ?>
                </ul>
            </div>
        </div>
    </nav><!--导航栏-->

    <div class="container">
        <?= $content ?>
    </div><!--主体内容-->
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; DingDing</p>
        <p class="pull-right">作者：张波</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
