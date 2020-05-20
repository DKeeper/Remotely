<?php
/** @var \yii\web\View $this */
/** @var RequestForm $requestForm */
/** @var string $requestOutput */
/** @var string $responseOutput */

use app\modules\request\forms\RequestForm;

?>
<div class="request-form">
    <?php
    $form = \yii\widgets\ActiveForm::begin([
        'id' => 'request-form'
    ]) ?>

    <?= $form->errorSummary($requestForm) ?>
    <?= $form->field($requestForm, 'id')->textInput() ?>
    <?= $form->field($requestForm, 'method')->dropDownList(array_combine(RequestForm::METHODS, RequestForm::METHODS)) ?>
    <?= $form->field($requestForm, 'page_uuid')->textInput() ?>
    <?= $form->field($requestForm, 'extended_field1')->textInput([
            'type' => 'number',
    ]) ?>
    <?= $form->field($requestForm, 'extended_field2')->textInput() ?>
    <?= $form->field($requestForm, 'extended_field3')->checkbox() ?>

    <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php \yii\widgets\ActiveForm::end() ?>
</div>
<div class="row">
    <div class="panel panel-default request-data">
        <div class="panel-heading">
            <h3 class="panel-title">Request data</h3>
        </div>
        <div class="panel-body"><?= $requestOutput ?></div>
    </div>
</div>
<div class="row">
    <div class="panel panel-default response-result">
        <div class="panel-heading">
            <h3 class="panel-title">Response data</h3>
        </div>
        <div class="panel-body"><?= $responseOutput ?></div>
    </div>
</div>
