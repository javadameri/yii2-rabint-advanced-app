<?php

use yii\db\Migration;

class m250417_064639_add_coluomn_in_header_for_model extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("{{%head_order_train_offline}}","model",$this->integer()->defaultValue(1)->comment("نوع سفر"));
        $this->addColumn("{{%head_order_train_offline}}","travel_time",$this->integer()->defaultValue(1)->comment("تعداد روز سفر"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250417_064639_add_coluomn_in_header_for_model cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250417_064639_add_coluomn_in_header_for_model cannot be reverted.\n";

        return false;
    }
    */
}
