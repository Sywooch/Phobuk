<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_has_photo_type`.
 */
class m170304_175058_create_user_has_photo_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('user_has_photo_type', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'photo_type_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('user_user_has_photo_type_index', 'user_has_photo_type', 'user_id');
        $this->createIndex('photo_type_user_has_photo_type_index', 'user_has_photo_type', 'photo_type_id');

        $this->addForeignKey('fk_user_has_photo_type_user_id', 'user_has_photo_type', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_has_photo_type_photo_type', 'user_has_photo_type', 'photo_type_id', 'photo_type', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_has_photo_type_user_id', 'user_has_photo_type');
        $this->dropForeignKey('fk_user_has_photo_type_photo_type', 'user_has_photo_type');
        $this->dropTable('user_has_photo_type');
    }
}
