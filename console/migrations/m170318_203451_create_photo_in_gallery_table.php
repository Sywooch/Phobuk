<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo_in_gallery`.
 */
class m170318_203451_create_photo_in_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('photo_in_gallery', [
            'id' => $this->primaryKey(),
            'photo_id' => $this->integer()->notNull(),
            'gallery_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('photo_in_gallery_photo_id_index', 'photo_in_gallery', 'photo_id');
        $this->createIndex('photo_in_gallery_gallery_id_index', 'photo_in_gallery', 'gallery_id');

        $this->addForeignKey('fk_photo_in_gallery_photo_id', 'photo_in_gallery', 'photo_id', 'photo', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_photo_in_gallery_gallery_id', 'photo_in_gallery', 'gallery_id', 'gallery', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_photo_in_gallery_photo_id', 'photo_in_gallery');
        $this->dropForeignKey('fk_photo_in_gallery_gallery_id', 'photo_in_gallery');
        $this->dropTable('photo_in_gallery');
    }
}
