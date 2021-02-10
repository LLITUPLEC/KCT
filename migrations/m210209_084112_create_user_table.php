<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210209_084112_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'date_birth' => $this->date(),
            'auth_key' => $this->string()->notNull(),
            'access_token' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'position_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_user_position',
            'users', 'position_id',
            'positions', 'id',
            'cascade'
        );

        $this->addForeignKey(
            'fk_user_city',
            'users', 'city_id',
            'cities', 'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_position', 'users');
        $this->dropForeignKey('fk_user_city', 'users');
        $this->dropTable('users');
    }
}
