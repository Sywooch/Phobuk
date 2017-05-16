<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_like`.
 */
class m170515_080224_create_post_like_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('post_like', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_post_like_post_id', 'post_like', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_like_user_id', 'post_like', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropForeignKey('fk_post_like_post_id', 'post_like');
        $this->dropForeignKey('fk_post_like_user_id', 'post_like');
        $this->dropTable('post_like');
    }
}
