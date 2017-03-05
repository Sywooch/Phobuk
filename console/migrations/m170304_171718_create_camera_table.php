<?php

use yii\db\Migration;

/**
 * Handles the creation of table `camera`.
 */
class m170304_171718_create_camera_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('camera', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'camera_brand_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('camera_user_index', 'camera', 'user_id');
        $this->createIndex('camera_camera_brand_index', 'camera', 'camera_brand_id');

        $this->addForeignKey('fk_camera_user_id', 'camera', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_camera_camera_brand_id', 'camera', 'camera_brand_id', 'camera_brand', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_camera_user_id', 'camera');
        $this->dropForeignKey('fk_camera_camera_brand_id', 'camera');
        $this->dropTable('camera');
    }
}
