<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 */
class m170430_091649_create_event_table extends Migration {
    /**
     * @inheritdoc
     */
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'organizer' => $this->integer()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'city_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_event_organizer', 'event', 'organizer', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_event_city_id', 'event', 'city_id', 'city', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->dropForeignKey('fk_event_organizer', 'event');
        $this->dropForeignKey('fk_event_city_id', 'event');
        $this->dropTable('event');
    }
}
