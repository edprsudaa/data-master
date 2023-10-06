<?php

use app\components\Helper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTindakan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="card card-default">
    <div class="card-header">
    <h3 class="card-title">Import data Tarif Tindakan</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="medis-tarif-tindakan-form">

            <?php $form = ActiveForm::begin([
                'options'=> ['enctype' => 'multipart/form-data']
            ]); ?>

            <?= $form->field($model, 'importFile')->label(false)->fileInput(['maxlength' => true]) ?>
            
            <?= Html::submitButton('Save', ['class' => 'btn-sm btn-success']) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>