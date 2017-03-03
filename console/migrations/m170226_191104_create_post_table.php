<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170226_191104_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'slug'=>$this->string(128)->notNull()->unique(),
            'lead_photo'=>$this->string(128),
            'content'=>$this->text()->notNull(),
            'created_at'=>$this->dateTime()->notNull(),
            'updated_at'=>$this->dateTime()->notNull(),
            'created_by'=>$this->integer()->notNull(),
        ]);

        $this->createIndex('post_index', 'post', ['created_by']);
        $this->addForeignKey('fk_post_user_created_by', 'post','created_by','user','id', 'CASCADE','CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_user_created_by', 'post');
        $this->dropTable('post');
    }
}
