<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170311_104901_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer(),
            'photo_id' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'update_at' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('post_user_id_index', 'post', 'user_id');
        $this->createIndex('post_category_id_index', 'post', 'category_id');
        $this->createIndex('post_photo_id_index', 'post', 'photo_id');

        $this->addForeignKey('fk_post_user_id', 'post', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_category_id', 'post', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_photo_id', 'post', 'photo_id', 'photo', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_user_id', 'post');
        $this->dropForeignKey('fk_post_category_id', 'post');
        $this->dropForeignKey('fk_post_photo_id', 'post');
        $this->dropTable('post');
    }
}
