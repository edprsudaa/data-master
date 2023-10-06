<?php

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranCaraMasukUnit */

$this->title = 'Update Pendaftaran Cara Masuk Unit: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Pendaftaran Cara Masuk Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>