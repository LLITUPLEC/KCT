<?php


namespace app\commands;


use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        /**
         *
         * Создание ролей пользователей
         *
         */
        // Пользователь
        $roleUser = $auth->createRole('user');
        $roleUser->description = 'Обычный пользователь сайта';

        $auth->add($roleUser);

        // Менеджер
        $roleAdmin = $auth->createRole('admin');
        $roleAdmin->description = 'Администратор сайта';

        $auth->add($roleAdmin);
        $auth->addChild($roleAdmin, $roleUser); // Админ наследует права Пользователя

        /**
         *
         * Установка ролей на пользователей
         *
         */
        $auth->assign($roleAdmin, 1);
        $auth->assign($roleUser, 2);
    }

}