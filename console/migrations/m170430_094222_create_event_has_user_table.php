<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event_has_user`.
 */
class m170430_094222_create_event_has_user_table extends Migration {
    /**
     * @inheritdoc
     */
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('event_has_user', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'update_at' => $this->dateTime()->notNull(),

        ], $tableOptions);
        $this->addForeignKey('fk_event_has_user_user_id', 'event_has_user', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_event_has_user_event_id', 'event_has_user', 'event_id', 'event', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->dropForeignKey('fk_event_has_user_user_id', 'event_has_user');
        $this->dropForeignKey('fk_event_has_user_event_id', 'event_has_user');
        $this->dropTable('event_has_user');
    }
}
