<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo_type`.
 */
class m170304_172252_create_photo_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('photo_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('photo_type');
    }
}
