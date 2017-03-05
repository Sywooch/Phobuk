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
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),


        ]);
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
