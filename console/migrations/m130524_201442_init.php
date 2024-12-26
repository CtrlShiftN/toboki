<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
	        'username' => $this->string()->notNull()->unique(),
	        'name' => $this->string(100)->notNull(),
	        'tel' => $this->string(12),
	        'address' => $this->string(),
	        'auth_key' => $this->string(32)->notNull(),
	        'password_hash' => $this->string()->notNull(),
	        'password_reset_token' => $this->string()->unique(),
	        'email' => $this->string()->notNull()->unique(),
	        'verified_at' => $this->dateTime(),
	        'verification_token' => $this->string()->defaultValue(null),
	        'referral_code' => $this->string()->notNull()->unique(),
	        'role' => $this->smallInteger()->notNull()->defaultValue(0)->comment('0 for admin, 1 for mod'),
	        'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('0 for inactive, 1 for active'),
	        'created_at' => $this->dateTime()->notNull(),
	        'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
