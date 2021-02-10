<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данного работника?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Назад', ['user/index'], ['class' => 'btn btn-info']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'username',
            [
                'label' => 'Должность',
                'attribute' => 'position_id',
                'value' => function (User $model) {
                    return $model->position->title;
                }
            ],
            [
                'label' => 'Город',
                'attribute' => 'city_id',
                'value' => function (User $model) {
                    return $model->city->city;
                },
                'headerOptions'=>['style' => 'text-align:center'],
            ],
            [
                'label' => 'Часвой пояс',
                'attribute' => 'city_id',
                'value' => function (User $model) {
                    return $model->city->timezone;
                },
                'headerOptions'=>['style' => 'text-align:center'],
            ],
            'date_birth:date',
            'email',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
