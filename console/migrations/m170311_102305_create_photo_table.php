<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo`.
 */
class m170311_102305_create_photo_table extends Migration
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

        $this->createTable('photo', [
            'id' => $this->primaryKey(),
            'photo' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'update_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
        $this->createIndex('photo_user_id_index', 'photo', 'user_id');
        $this->createIndex('photo_category_id_index', 'photo', 'category_id');

        $this->addForeignKey('fk_photo_user_id', 'photo', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_photo_category_id', 'photo', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_photo_user_id', 'photo');
        $this->dropForeignKey('fk_photo_category_id', 'photo');
        $this->dropTable('photo');
    }
}
