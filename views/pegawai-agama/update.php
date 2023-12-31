<?php

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiAgama */

$this->title = 'Update Pegawai Agama: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pegawai Agama', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
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