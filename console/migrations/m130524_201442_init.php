<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'text' => $this->text(),
            'level' => $this->integer()->notNull(),
            'city_id' => $this->integer(),
        ], $tableOptions);
        $this->createIndex('user_city_index', 'user', 'city_id');
        $this->createIndex('user_level_index', 'user', 'level');


    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_user_city_id', 'user');
        $this->dropTable('{{%user}}');
    }
}
