<?php

use yii\db\Migration;

class m250327_183801_create_table_train_order_offline extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("{{%head_order_train_offline}}",[
            'id' => $this->primaryKey()->comment("شناسه"),
            "full_name"=>$this->string(255)->comment("معرف"),
            "cell"=>$this->string(255)->comment("شماره تماس"),
            "code"=>$this->string(50)->comment("کد"),
            "description"=>$this->text()->comment("توضیحات"),
            "user_id"=>$this->integer()->comment("کاربر"),
            "from"=>$this->integer()->comment("مبدا"),
            "to"=>$this->integer()->comment("مقصد"),
            "date"=>$this->string()->comment("تاریخ"),
            "type"=>$this->string()->comment("نوع قطار"),
            "status"=>$this->integer()->comment("وضعیت"),
            "price"=>$this->integer()->comment("قیمت"),
            "transaction_id"=>$this->integer()->comment("فاکتور"),
            "ticket_file"=>$this->integer()->comment("فایل بلیت"),
            "request_type"=>$this->integer()->comment("نوع درخواست"),
            "created_at"=>$this->integer()->comment("ایجاد شده در"),
            "updated_at"=>$this->integer()->comment("بروزرسانی شده در"),
            "created_by"=>$this->integer()->comment("ایجاد شده توسط"),
            "updated_by"=>$this->integer()->comment("بروزرسانی شده توسظ"),
        ]);
        $this->execute("ALTER TABLE head_order_train_offline AUTO_INCREMENT = 1000");


        $this->createTable("{{%item_order_train_offline}}",[
            'id' => $this->primaryKey()->comment("شناسه"),
            "client_type"=>$this->integer()->comment("نوع مسافر"),
            "full_name"=>$this->string(255)->comment("نام و نام خانوادگی"),
            "melli_code"=>$this->string(20)->comment("کدملی"),
            "birthdate"=>$this->string(20)->comment("تاریخ تولد"),
            "description"=>$this->text()->comment("توضیحات"),
            "order_id"=>$this->integer()->comment("سفارش"),
            "shahed_cart"=>$this->integer()->comment("کارت شاهد"),
            "shahed_back"=>$this->integer()->comment("پشت کارت شاهد"),
            "created_at"=>$this->integer()->comment("ایجاد شده در"),
            "updated_at"=>$this->integer()->comment("بروزرسانی شده در"),
            "created_by"=>$this->integer()->comment("ایجاد شده توسط"),
            "updated_by"=>$this->integer()->comment("بروزرسانی شده توسظ"),
        ]);

        $this->addForeignKey("fk_order_header_item","{{%item_order_train_offline}}","order_id","{{%head_order_train_offline}}","id","CASCADE","CASCADE");
        $this->addForeignKey("fk_order_header_transaction","{{%head_order_train_offline}}","transaction_id","{{%finance_transactions}}","id","CASCADE","CASCADE");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250327_183801_create_table_train_order_offline cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250327_183801_create_table_train_order_offline cannot be reverted.\n";

        return false;
    }
    */
}
