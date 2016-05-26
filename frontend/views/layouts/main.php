<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Menu;
use yii\helpers\Url;
use frontend\assets\AppAsset;

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\widgets\Alert;

$bundle = AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$bundle->baseUrl.'/images/apple-icon.png'?>">
    <link rel="icon" type="image/x-icon" sizes="96x96" href="<?=$bundle->baseUrl.'/images/favicon.ico?'.microtime()?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="info">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://testmatick.com" class="simple-text">
                    TestMatick Portal
                </a>
            </div>
            
            
            <div class="sidebar-user">
                <div class="card card-user card-sidebar">
                    <div class="content">
                        <div class="author">
                            <?= Html::img($bundle->baseUrl.'/images/faces/face-3.jpg',['class'=>'avatar border-white'])?>
                            <?=  common\widgets\GreetingsWidget::widget()?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            echo Menu::widget([
                'items' => [
                    // Important: you need to specify url as 'controller/action',
                    // not just as 'controller' even if default action is used.
                    ['label' => 'Home', 'url' => ['site/index'], 'template' => '<a href="{url}"><i class="ti-panel"></i><p>{label}</p></a>'],
                    ['label' => 'User profile', 'url' => ['user/index'], 'template' => '<a href="{url}"><i class="ti-user"></i><p>{label}</p></a>'],
                ],
                'options' => [
                    'class' => 'nav',
                ],
                'activeCssClass' => 'active',
            ]);
            ?>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
									<p>Notifications</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <?php if(Yii::$app->user->identity->username == 'admin'): ?>
                        <li>
                            <a href="<?=Url::toRoute('/backend')?>">
								<i class="ti-settings"></i>
								<p>Administration</p>
                            </a>
                        </li>
                        <?php endif; ?>
						<li>
                            <?php if(Yii::$app->user->isGuest):?>
                                <a href="<?=Url::toRoute('site/login')?>" data-method="post">
                                    <i class="ti-power-off"></i>
                                    <p>Login</p>
                                </a>
                            <?php else:?>
                                <a href="<?=Url::toRoute('site/logout')?>" data-method="post">
                                    <i class="ti-power-off"></i>
                                    <p>Logout</p>
                                </a>
                            <?php endif;?>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <?= Yii::powered() ?>
                        </li>
<!--                        <li>
                            <a href="http://blog.creative-tim.com">
                               Blog
                            </a>
                        </li>-->
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    <a href="http://testmatick.com">&copy; TestMatick Ltd. <?= date('Y') ?></a>
                </div>
            </div>
        </footer>
        <script type="text/javascript">
            $(document).ready(function(){

//                demo.initChartist();
            });
        </script>
    </div>
</div>
<!--<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
