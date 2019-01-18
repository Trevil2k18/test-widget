<?php

use yii\db\Migration;

/**
 * Class m190117_220839_create_table_fingerprints
 */
class m190117_220839_create_table_fingerprints extends Migration
{
    public function safeUp()
    {
        $this->createTable('fingerprints', [
            'id' => $this->primaryKey(),
            'fingerprint' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string()->notNull()
        ]);

        $this->insert('fingerprints', [
            'fingerprint' => 'cec111f201d55ae03059985fdc98dfaa',
            'name' => 'Ilya',
            'phone' => '+7-909-923-09-57',
            'email' => 'trevil2k11@gmail.com'
        ]);
    }

    public function safeDown()
    {
        $this->truncateTable('fingerprints');
        $this->dropTable('fingerprints');
    }
}
