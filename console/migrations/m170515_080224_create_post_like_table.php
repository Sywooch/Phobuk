<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_like`.
 */
class m170515_080224_create_post_like_table extends Migration {
    /**
     * @inheritdoc
     */
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('post_like', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_post_like_post_id', 'post_like', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_like_user_id', 'post_like', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->dropForeignKey('fk_post_like_post_id', 'post_like');
        $this->dropForeignKey('fk_post_like_user_id', 'post_like');
        $this->dropTable('post_like');
    }
}
