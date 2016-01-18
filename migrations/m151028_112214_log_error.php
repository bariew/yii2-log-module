<?php

use yii\db\Migration;

class m151028_112214_log_error extends Migration
{
    private $table = '{{%log_error}}';

    public function up()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'level' => $this->integer(),
            'category' => $this->string(),
            'log_time' => $this->integer(),
            'prefix' => $this->string(),
            'message' => $this->text(),
        ]);
        $this->createIndex('idx_log_level', $this->table, 'level');
        $this->createIndex('idx_log_category', $this->table, 'category');
        return true;
    }

    public function down()
    {
        return $this->dropTable($this->table);
    }
}
