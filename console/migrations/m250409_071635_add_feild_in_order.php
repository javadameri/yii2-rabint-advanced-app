<?php

use yii\db\Migration;

class m250409_071635_add_feild_in_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("{{%head_order_train_offline}}","reserve_time",$this->integer()->comment("زمان انجام رزرو"));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250409_071635_add_feild_in_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250409_071635_add_feild_in_order cannot be reverted.\n";

        return false;
    }
    */
}
