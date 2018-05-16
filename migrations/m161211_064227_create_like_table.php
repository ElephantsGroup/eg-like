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

        $this->insert('{{%auth_item}}', [
            'name' => '/like/admin/*',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'like_management',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'like_management',
            'child' => '/like/admin/*',
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'like_manager',
            'type' => 1,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'like_manager',
            'child' => 'like_management',
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'super_admin',
            'child' => 'like_manager',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'super_admin',
            'child' => 'like_manager',
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'like_manager',
            'child' => 'like_management',
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => 'like_manager',
            'type' => 1,
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'like_management',
            'child' => '/like/admin/*',
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => 'like_management',
            'type' => 2,
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => '/like/admin/*',
            'type' => 2,
        ]);
        $this->dropTable('{{%eg_like}}');
    }
}
