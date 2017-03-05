<?php

use yii\db\Migration;

/**
 * Handles the creation of table `camera_brand`.
 */
class m170304_171427_create_camera_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('camera_brand', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('camera_brand');
    }
}
