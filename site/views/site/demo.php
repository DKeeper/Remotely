<?php
/** @var yii\web\View $this */
use app\widgets\ClientForm\Form;
use yii\helpers\ArrayHelper;
?>
<div class="site-demo">
    <?= Form::widget([
        'ajaxUrl' => ArrayHelper::getValue(Yii::$app->params, 'service.ajaxUrl'),
    ]) ?>
</div>
