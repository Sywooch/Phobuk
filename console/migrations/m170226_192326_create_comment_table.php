<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170226_192326_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'post_id' =>$this->integer()->notNull(),
            'lead_photo'=>$this->string(128),
            'content'=>$this->text()->notNull(),
            'created_at'=>$this->dateTime()->notNull(),
            'updated_at'=>$this->dateTime()->notNull(),
            'created_by'=>$this->integer()->notNull()
        ]);
        $this->addForeignKey('fk_comment_post_id', 'comment', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_user_created_by', 'comment', 'created_by', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comment_post_id', 'comment');
        $this->dropForeignKey('fk_comment_user_created_by', 'comment');
        $this->dropTable('comment');
    }
}
