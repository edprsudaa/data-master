<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Suku */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="suku-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

     <?php if(!$model->isNewRecord):?>

         <?= 
            $form->field($model, 'aktif')->widget(Select2::classname(), [
                'data' => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                'options' => ['placeholder' => 'Pilih...'],
            ])->label('Status'); 
        ?>

    <?php endif;?>


    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?> -->

   <div class="form-group float-sm-right">
        <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
