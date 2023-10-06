<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MedisIcd9cm */

$this->title = $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Medis Icd9cm 2010', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id',
                            // 'parent_id',
                            'kode',
                            'deskripsi:ntext',
                            // [
                            //     'label' => 'Referensi',
                            //     'value' => $referensi,
                            // ],
                            // 'keterangan:ntext',
                            'aktif',
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>