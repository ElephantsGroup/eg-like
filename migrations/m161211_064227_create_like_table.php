<?php

use yii\db\Migration;

/**
 * Handles the creation of table `like`.
 */
class m161211_064227_create_like_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%eg_like}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(32),
            'cookie' => $this->string(512),
            'item_id' => $this->integer(11),
            'service_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'like' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%eg_like}}');
    }
}
