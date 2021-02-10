<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

 /* @var $model Position */

use app\models\Position;
use app\models\City;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Список работников';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Зарегистрировать нового пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
    [
        'class' => SerialColumn::class,
        'header' => 'Порядковый номер',
    ],
    'username',
    'email',
    [
        'label' => 'Должность',
        'attribute' => 'position_id',
        'value' => function (User $model) {
            return $model->position->title;
        },
        'headerOptions'=>['style' => 'text-align:center'],
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
    [
        'class' => ActionColumn::class,
        'header' => 'Операции',
        'contentOptions' => ['style' => 'text-align:center'],
        'headerOptions'=>['style' => 'text-align:center'],
    ],
    ],
])?>

</div>