<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170311_110312_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'photo_id' => $this->integer(),
            'post_id' => $this->integer(),
        ]);
        $this->createIndex('comment_user_id_index', 'comment', 'user_id');
        $this->createIndex('comment_photo_id_index', 'comment', 'photo_id');
        $this->createIndex('comment_post_id_index', 'comment', 'post_id');

        $this->addForeignKey('fk_comment_user_id', 'comment', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_photo_id', 'comment', 'photo_id', 'photo', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_post_id', 'comment', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comment_user_id', 'comment');
        $this->dropForeignKey('fk_comment_photo_id', 'comment');
        $this->dropForeignKey('fk_comment_post_id', 'comment');
        $this->dropTable('comment');
    }
}
