<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo_has_user`.
 */
class m170311_103108_create_photo_has_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('photo_has_user', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'photo_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex('photo_has_user_user_id_index', 'photo_has_user', 'user_id');
        $this->createIndex('photo_has_user_photo_id_index', 'photo_has_user', 'photo_id');

        $this->addForeignKey('fk_photo_has_user_user_id', 'photo_has_user', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_photo_has_user_photo_id', 'photo_has_user', 'photo_id', 'photo', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_photo_has_user_user_id', 'photo_has_user');
        $this->dropForeignKey('fk_photo_has_user_photo_id', 'photo_has_user');
        $this->dropTable('photo_has_user');
    }
}
