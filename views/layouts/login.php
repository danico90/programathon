<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>La Voz del Cliente</title>
    <?php $this->head() ?>
</head>
<body class="login-page">
    <div class="wrapper">
        <?php $this->beginBody() ?>
            <h1 class="title login-text">La Voz del Cliente</h1>
            <?= $content ?>
        <?php $this->endBody() ?>
    </div>
</body>
</html>
<?php $this->endPage() ?>
