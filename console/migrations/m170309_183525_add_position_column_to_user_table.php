<?php

use yii\db\Migration;

/**
 * Handles adding position to table `user`.
 */
class m170309_183525_add_position_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('user', 'first_name', $this->string()->after('id'));
        $this->addColumn('user', 'last_name', $this->string()->after('first_name'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'first_name');
        $this->dropColumn('user', 'last_name');
    }
}
