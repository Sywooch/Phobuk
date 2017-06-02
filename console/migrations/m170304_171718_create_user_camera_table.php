<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_camera`.
 */
class m170304_171718_create_user_camera_table extends Migration {
    /**
     * @inheritdoc
     */
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user_camera', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'camera_brand_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('camera_user_index', 'user_camera', 'user_id');
        $this->createIndex('camera_camera_brand_index', 'user_camera', 'camera_brand_id');

        $this->addForeignKey('fk_camera_user_id', 'user_camera', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_camera_camera_brand_id', 'user_camera', 'camera_brand_id', 'camera_brand', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->dropForeignKey('fk_camera_user_id', 'user_camera');
        $this->dropForeignKey('fk_camera_camera_brand_id', 'user_camera');
        $this->dropTable('user_camera');
    }
}
