<?php

use yii\db\Migration;

class m250327_174804_create_tabel_train_station extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // ایجاد جدول
        $this->createTable('train_stations', [
            'id' => $this->primaryKey()->comment("شناسه"),
            'code' => $this->integer()->notNull()->comment("کد استگاه"),
            'name' => $this->string(255)->notNull()->comment("ٔنام فارسی"),
            'english_name' => $this->string(255)->notNull()->comment("نام انگلیسی"),
            'tel_code' => $this->string(50)->comment("کد تلفن"),
            'station_group' => $this->string(255)->comment("دسته بندی ایستگاه"),
            'is_car_ticket' => $this->boolean()->defaultValue(0)->comment("آیا بلیت خودرو هست؟"),
            'is_exclusion' => $this->boolean()->defaultValue(0)->comment("آیا استثنا هست؟"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250327_174804_create_tabel_train_station cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250327_174804_create_tabel_train_station cannot be reverted.\n";

        return false;
    }
    */
}
