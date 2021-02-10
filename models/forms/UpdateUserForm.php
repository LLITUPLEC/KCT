<?php

namespace app\models\forms;

use app\models\User;
use yii\base\Model;

class UpdateUserForm extends Model
{
    public $password;
    public $reenter_password;

    public function rules()
    {
        return [
            [['password', 'reenter_password'], 'string'],
            [['password'], 'string', 'min' => 6, 'max' => 30],
            [['reenter_password'], 'compare', 'compareAttribute' => 'password', 'when' => function (UpdateUserForm $form) {
                return !empty($form->password);
            }],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Новый пароль',
            'reenter_password' => 'Повторите пароль',
        ];
    }

    public function updatePass()
    {
        $user = User::findIdentity(\Yii::$app->user->id);

        if (!$this->validate()) {
            return false;
        }

        if (!empty($this->password) &&
            $this->password === $this->reenter_password) {
            $user->password = $this->password;
        } else {
            return false;
        }
        return $user->save(false);
    }

}