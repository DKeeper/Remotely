<?php

use yii\db\Migration;

/**
 * Class m200516_000000_init_DB
 */
class m200516_000000_init_DB extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('data', [
            'id' => $this->primaryKey(),
            'page_uuid' => $this->string(36)->notNull(),
            'created' => $this->date()->notNull()->defaultValue('1000-01-01'),
            'extended' => $this->text(),
        ]);
        $this->createIndex('id_page_uuid', 'data', ['id', 'page_uuid'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('data');

        echo "m200512_184904_init_DB cannot be reverted.\n";

        return true;
    }
}
