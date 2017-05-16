<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo_like`.
 */
class m170515_080235_create_photo_like_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('photo_like', [
            'id' => $this->primaryKey(),
            'photo_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_photo_like_photo_id', 'photo_like', 'photo_id', 'photo', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_photo_like_user_id', 'photo_like', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropForeignKey('fk_photo_like_photo_id', 'photo_like');
        $this->dropForeignKey('fk_photo_like_user_id', 'photo_like');
        $this->dropTable('photo_like');
    }
}
