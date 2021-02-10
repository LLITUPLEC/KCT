<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class City
 * @package app\models
 *
 * @property int $id
 * @property string $city
 * @property string $timezone
 */
class City extends ActiveRecord
{
    public static function tableName()
    {
        return 'cities';
    }

    public function attributeLabels()
    {
        return [
            'id' => '№',
            'city' => 'Город',
            'timezone' => 'Часовой пояс',
        ];
    }
}