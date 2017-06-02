<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friendship`.
 */
class m170329_092345_create_friendship_table extends Migration
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
        $this->createTable('friendship', [
            'id' => $this->primaryKey(),
            'friend_one' => $this->integer()->notNull(),
            'friend_two' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
        $this->createIndex('friendship_friend_one_index', 'friendship', 'friend_one');
        $this->createIndex('friendship_friend_two_index', 'friendship', 'friend_two');

        $this->addForeignKey('fk_friendship_friend_one', 'friendship', 'friend_one', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_friendship_friend_two', 'friendship', 'friend_two', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_friendship_friend_one', 'friendship');
        $this->dropForeignKey('fk_friendship_friend_two', 'friendship');
        $this->dropTable('friendship');
    }
}
