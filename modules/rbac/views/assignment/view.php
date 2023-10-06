<?php

use app\modules\rbac\AnimateAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model app\modules\rbac\models\Assignment */
/* @var $fullnameField string */

$userName = $model->{$usernameField};
if (!empty($fullnameField)) {
    $userName .= ' (' . ArrayHelper::getValue($model, $fullnameField) . ')';
}
$userName = Html::encode($userName);

$this->title = Yii::t('rbac-admin', 'Assignment') . ' : ' . $userName;

$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
// echo'<pre/>';print_r($model->getItems());die();
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="fas fa-spinner glyphicon-refresh-animate"></i>';
?>
<div class="assignment-index">
    <div class="row">
        <div class="col-sm-5">
            <input class="form-control form-control-sm search" data-target="available"
                   placeholder="<?=Yii::t('rbac-admin', 'Search for available');?>">
            <select multiple size="20" class="form-control list" data-target="available">
            </select>
        </div>
        <div class="col-sm-1">
            <br><br>
            <?=Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => (string) $model->id], [
    'class' => 'btn btn-success btn-assign',
    'data-target' => 'available',
    'title' => Yii::t('rbac-admin', 'Assign'),
]);?><br><br>
            <?=Html::a('&lt;&lt;' . $animateIcon, ['revoke', 'id' => (string) $model->id], [
    'class' => 'btn btn-danger btn-assign',
    'data-target' => 'assigned',
    'title' => Yii::t('rbac-admin', 'Remove'),
]);?>
        </div>
        <div class="col-sm-5">
            <input class="form-control form-control-sm search" data-target="assigned"
                   placeholder="<?=Yii::t('rbac-admin', 'Search for assigned');?>">
            <select multiple size="20" class="form-control list" data-target="assigned">
            </select>
        </div>
    </div>
</div>
