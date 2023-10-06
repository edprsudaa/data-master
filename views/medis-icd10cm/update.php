<?php

/* @var $this yii\web\View */
/* @var $model app\models\MedisIcd10cm */

$this->title = 'Update Medis Icd10cm: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Medis Icd10cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'icd10cm' => $icd10cm,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>