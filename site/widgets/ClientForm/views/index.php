<?php
/** @var yii\web\View $this */
/** @var string $uuid */
/** @var string $formId */
/** @var string $ajaxUrl */
/** @var array $methods */
?>
<form id="<?= $formId ?>" data-url="<?= $ajaxUrl ?>">
    <div class="form-group">
        <label for="methods">Select method</label>
        <?= \yii\helpers\Html::dropDownList('methods', null, $methods, [
             'class' => 'form-control',
        ]) ?>
    </div>
    <div class="form-group field-id hidden">
        <label for="page_uuid">ID</label>
        <?= \yii\helpers\Html::input('text', 'id', '', [
            'class' => 'form-control',
        ]) ?>
    </div>
    <div class="form-group">
        <label for="page_uuid">Current page UUID</label>
        <?= \yii\helpers\Html::input('text', 'page_uuid', $uuid, [
            'class' => 'form-control',
        ]) ?>
    </div>
    <div class="form-group">
        <label for="extended">Extended field #1</label>
        <?= \yii\helpers\Html::input('text', 'extended.field1', '', [
            'class' => 'form-control',
        ]) ?>
    </div>
    <div class="form-group">
        <label for="extended">Extended field #2</label>
        <?= \yii\helpers\Html::input('text', 'extended.field2', '', [
            'class' => 'form-control',
        ]) ?>
    </div>
    <div class="form-group">
        <label for="extended">Extended field #3</label>
        <?= \yii\helpers\Html::input('text', 'extended.field3', '', [
            'class' => 'form-control',
        ]) ?>
    </div>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('Send request', [
            'class' => 'btn btn-success',
        ]) ?>
    </div>
</form>
<div class="panel panel-default request-data">
    <div class="panel-heading">
        <h3 class="panel-title">Request data</h3>
    </div>
    <div class="panel-body">
        No data, send anything
    </div>
</div>
<div class="panel panel-default response-result">
    <div class="panel-heading">
        <h3 class="panel-title">Response data</h3>
    </div>
    <div class="panel-body">
        No data, send anything
    </div>
</div>
