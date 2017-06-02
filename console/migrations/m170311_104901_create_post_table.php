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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'title' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'photo_id' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'update_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('post_user_id_index', 'post', 'user_id');
        $this->createIndex('post_photo_id_index', 'post', 'photo_id');

        $this->addForeignKey('fk_post_user_id', 'post', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_photo_id', 'post', 'photo_id', 'photo', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_user_id', 'post');
        $this->dropForeignKey('fk_post_photo_id', 'post');
        $this->dropTable('post');
    }
}
