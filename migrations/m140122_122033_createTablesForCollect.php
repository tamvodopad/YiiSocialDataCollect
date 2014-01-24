<?php

class m140122_122033_createTablesForCollect extends EDbMigration
{
	public function safeUp()
	{
		$this->createTable('social_data', array(
            'id' => "pk",
            'social_type_id' => 'int(11) NOT NULL COMMENT "Id of social type"',
            'data_id' => 'string NOT NULL COMMENT "Id of social type"',
            'status' => 'int(11) NOT NULL DEFAULT 1 COMMENT "Published status for this content"',
            'data' => 'TEXT NOT NULL COMMENT "raw json data of single post"',
            'created' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));

        $this->createTable('social_types', array(
            'id' => "pk",
            'name' => 'string NOT NULL COMMENT "name of social"',            
        ));

        //$this->createIndex('social_data_social_type', 'social_data', 'social_type_id', true);

        $this->addForeignKey('social_type_id', 'social_data', 'social_type_id', 'social_types', 'id', 'CASCADE', 'RESTRICT');

        $this->insert('social_types', array(
            "name" => "Facebook",            
        ));
		
		$this->insert('social_types', array(
            "name" => "Twitter",            
        ));

        $this->insert('social_types', array(
            "name" => "Instagram",
        ));

        $this->insert('social_types', array(
            "name" => "Vimeo",
        ));
	}

	public function safeDown()
	{
		$this->dropTable('social_data');
		$this->dropTable('social_types');
				

		//echo "m140122_122033_createTablesForCollect does not support migration down.\n";
		//return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}