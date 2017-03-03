<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friend`.
 */
class m170226_195734_create_friend_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('friend', [
            'id' => $this->primaryKey(),
            'invited' =>$this->integer()->notNull(),
            'inviter' =>$this->integer()->notNull()

        ]);
        $this->createIndex('friend_index', 'friend', ['invited']);
        $this->addForeignKey('fk_friend_user_invited', 'friend','invited','user','id', 'CASCADE','CASCADE');
        $this->addForeignKey('fk_friend_user_inviter', 'friend','inviter','user','id', 'CASCADE','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_friend_user_invited', 'friend');
        $this->dropForeignKey('fk_friend_user_inviter', 'friend');
        $this->dropTable('friend');
    }
}
