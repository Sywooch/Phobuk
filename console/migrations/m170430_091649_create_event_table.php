<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 */
class m170430_091649_create_event_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'organizer' => $this->integer()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'city_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_event_organizer', 'event', 'organizer', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_event_city_id', 'event', 'city_id', 'city', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropForeignKey('fk_event_organizer', 'event');
        $this->dropForeignKey('fk_event_city_id', 'event');
        $this->dropTable('event');
    }
}
