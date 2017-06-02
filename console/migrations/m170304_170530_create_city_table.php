<?php

use yii\db\Migration;

/**
 * Handles the creation of table `city`.
 */
class m170304_170530_create_city_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),

        ], $tableOptions);
        $this->addForeignKey('fk_user_city_id', 'user', 'city_id', 'city', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('city');
    }
}
