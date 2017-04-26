<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_has_category`.
 */
class m170420_095932_create_post_has_category_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('post_has_category', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_post_has_category_post', 'post_has_category', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_has_category_category', 'post_has_category', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropForeignKey('fk_post_has_category_post', 'post_has_category');
        $this->dropForeignKey('fk_post_has_category_category', 'post_has_category');
        $this->dropTable('post_has_category');
    }
}
