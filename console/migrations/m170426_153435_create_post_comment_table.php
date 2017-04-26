<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_comment`.
 */
class m170426_153435_create_post_comment_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('post_comment', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'post_id' => $this->integer(),
        ]);
        $this->createIndex('post_comment_user_id_index', 'post_comment', 'user_id');
        $this->createIndex('post_comment_post_id_index', 'post_comment', 'post_id');


        $this->addForeignKey('fk_post_comment_user_id', 'post_comment', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_comment_post_id', 'post_comment', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropForeignKey('fk_post_comment_user_id', 'post_comment');
        $this->dropForeignKey('fk_post_comment_post_id', 'post_comment');
        $this->dropTable('post_comment');
    }
}
