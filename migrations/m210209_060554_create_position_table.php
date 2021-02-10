<?php

use yii\db\Migration;

/**
 * Handles the creation of table `position`.
 */
class m210209_060554_create_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('positions', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);

        $this->insertData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('positions');
    }

    private function insertData()
    {
        $this->insert('positions', [
            'id' => 1,
            'title' => 'Грузчик',
        ]);
        $this->insert('positions', [
            'id' => 2,
            'title' => 'Кладовщик',
        ]);
        $this->insert('positions', [
            'id' => 3,
            'title' => 'Мастер',
        ]);
    }
}
