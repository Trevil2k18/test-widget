<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use app\components\FingerCatchWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Main test page</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<script async src="//stats.lptracker.ru/code/new/60074"></script>

<?= FingerCatchWidget::widget() ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
