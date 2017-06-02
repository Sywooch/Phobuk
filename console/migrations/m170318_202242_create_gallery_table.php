<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gallery`.
 */
class m170318_202242_create_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull()->defaultValue(1),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'title' => $this->string()->notNull(),
        ], $tableOptions);
        $this->createIndex('gallery_user_id_index', 'gallery', 'user_id');

        $this->addForeignKey('fk_gallery_user_id', 'gallery', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_gallery_user_id', 'gallery');
        $this->dropTable('gallery');
    }
}
