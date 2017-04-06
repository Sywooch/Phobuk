<?php

use yii\db\Migration;

/**
 * Handles adding position to table `user`.
 */
class m170330_064302_add_position_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('user', 'avatar', $this->integer()->after('last_name'));
        $this->addForeignKey('fk_user_avatar', 'user', 'avatar', 'photo', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'avatar');
        $this->dropForeignKey('fk_user_avatar', 'user');
    }
}
