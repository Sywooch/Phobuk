<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo_comment`.
 */
class m170311_110312_create_photo_comment_table extends Migration
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
        $this->createTable('photo_comment', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'photo_id' => $this->integer(),

        ], $tableOptions);
        $this->createIndex('comment_user_id_index', 'photo_comment', 'user_id');
        $this->createIndex('comment_photo_id_index', 'photo_comment', 'photo_id');

        $this->addForeignKey('fk_comment_user_id', 'photo_comment', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_photo_id', 'photo_comment', 'photo_id', 'photo', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comment_user_id', 'photo_comment');
        $this->dropForeignKey('fk_comment_photo_id', 'photo_comment');
        $this->dropTable('photo_comment');
    }
}
