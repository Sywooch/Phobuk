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
    public function up()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull()->defaultValue(1),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer(),
            'title' => $this->string()->notNull(),
        ]);
        $this->createIndex('gallery_user_id_index', 'gallery', 'user_id');
        $this->createIndex('gallery_category_id_index', 'gallery', 'category_id');

        $this->addForeignKey('fk_gallery_user_id', 'gallery', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_gallery_category_id', 'gallery', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_gallery_user_id', 'gallery');
        $this->dropForeignKey('fk_gallery_category_id', 'gallery');
        $this->dropTable('gallery');
    }
}
