<?php

use app\models\Position;
use app\models\City;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>


<div class="user-form">

    <?php $form = ActiveForm::begin([
//        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label', 'id' => 'memberssearch-family_name_id' ],
        ],
    ]); ?>

    <div class="col" style="display: flex">
        <div  class="col-lg-6">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?php  //Отображаем поля только при СОЗДАНИИ нового работника
            if (Yii::$app->request->pathInfo == 'user/create') {
                echo $form->field($model, 'password')->passwordInput();
            }
            ?>

            <?= $form->field($model, 'date_birth')->textInput(['type' => 'date']) ?>

            <?php
            // получаем все должности
            $users = Position::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'title'
            $items = ArrayHelper::map($users,'id','title');
            $params = [
                'prompt' => 'Выбрать'
            ];
            echo $form->field($model, 'position_id')->dropDownList($items,$params)->label('Должность');
            ?>

            <?php
            $cities = City::find()->select(['id as value', 'city as label'])->asArray()->all();
            echo $form->field($model, 'city_id')->widget(AutoComplete::class, [
                'clientOptions' => [
                    'source' => $cities,
//                    'autoFill' => true,
//                    'minLength' => 2,
//                    'select' => new JsExpression("function( event, ui ) {
//                        console.log(ui.item);
//                        document.getElementById('cut_id').value = ui.item.value;
//                        document.getElementById('cit_id').value = ui.item.label;
//                        }"
//                    )
                ],
                'options' => [
                    'class' => 'form-control',
                ],
            ]);
//            print_r($cities)
            ?>

        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
