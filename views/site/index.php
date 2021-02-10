<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Форма регистрации';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>

        <?php
        if (Yii::$app->user->isGuest) {
            echo '<p class=\"lead\">Пожалуйста, авторизуйтесь или зарегистрируйтесь.</p>';
            echo Html::a('Зарегестрироваться', ['site/signup'], ['class' => 'btn btn-success', 'style' => 'margin-top: 30px']);
        }
        ?>

    </div>
</div>
