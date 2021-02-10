<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Exception;
use yii\base\Model;


class SignupForm extends Model
{
    /**
     * @var int Идентификатор работника в БД
     */
    public $id;
    /**
     * @var string Логин для создания пользователя
     */
    public $username;
    /**
     * @var string Новый пароль пользователя
     */
    public $password;
    /**
     * @var string Должность(роль)
     */
    public $position_id;
    /**
     * @var int Дата рождения работника
     */
    public $date_birth;
    /**
     * @var string Электронная почта
     */
    public $email;
    /**
     * @var string Город
     */
    public $city_id;

    /**
     * Названия атрибутов формы
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'position_id' => 'Должность',
            'date_birth' => 'Дата рождения',
            'email' => 'Электронная почта',
            'city_id' => 'Город',
        ];
    }

    /**
     * Правила валидации полей формы
     * @return array
     */
    public function rules()
    {
        return [
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email'],
            [['username', 'password', 'position_id', 'city_id', 'email',], 'required'],
            [['username', 'password', 'position_id', 'email', 'city_id', 'date_birth'], 'string'],
            [['username'], 'string', 'min' => 3],
            [['password'], 'string', 'min' => 6, 'max' => 20],
        ];
    }

    /**
     * Попытка регистрации пользователя
     * @return User|null
     * @throws \Exception
     */
    public function register()
    {
        // если валидация прошла успешно
        if ($this->validate()) {
            $user = new User([
                'username' => $this->username,
                'access_token' => "{$this->username}-token",
//                'created_at' => time(),
//                'updated_at' => time(),
                'position_id' => $this->position_id,
                'date_birth' => $this->date_birth,
                'city_id' => $this->city_id,
                'email' => $this->email,
            ]);

            $user->generateAuthKey();
            $user->password = $this->password;

            if ($user->save()) {
                // назначение пользователю базовой роли User
                $auth = Yii::$app->authManager;

                $role = $auth->getRole('user');

                $auth->assign($role, $user->id);

                return $user;
//                return Yii::$app->runAction('user/index');
            }
        }

        // вернем false, если не прошла валидация
        return null;
    }
}
