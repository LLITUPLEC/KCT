<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Position
 * @package app\models
 *
 * @property int $id
 * @property string $title
 */
class Position extends ActiveRecord
{
    public static function tableName()
    {
        return 'positions';
    }

    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Занимаемая должность',
        ];
    }
}