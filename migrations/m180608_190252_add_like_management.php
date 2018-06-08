<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m180608_190252_add_like_management
 */
class m180608_190252_add_like_management extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$db = \Yii::$app->db;
		$query = new Query();
        if ($db->schema->getTableSchema("{{%auth_item}}", true) !== null)
		{
			if (!$query->from('{{%auth_item}}')->where(['name' => '/like/admin/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/like/admin/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'like_management'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'like_management',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'like_manager'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'like_manager',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'administrator'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'administrator',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_item_child}}", true) !== null)
		{
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'like_management', 'child' => '/like/admin/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'like_management',
					'child'		=> '/like/admin/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'like_manager', 'child' => 'like_management'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'like_manager',
					'child'		=> 'like_management'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'administrator', 'child' => 'like_manager'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'administrator',
					'child'		=> 'like_manager'
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_assignment}}", true) !== null)
		{
			if (!$query->from('{{%auth_assignment}}')->where(['item_name' => 'administrator', 'user_id' => 1])->exists())
				$this->insert('{{%auth_assignment}}', [
					'item_name'	=> 'administrator',
					'user_id'	=> 1,
					'created_at' => time()
				]);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		// it's not safe to remove auth data in migration down
    }
}
