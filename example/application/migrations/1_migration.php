<?php
/* DATABASE MIGRATION */

function migration_1_up($CI) {
	$CI->dbforge->add_field(array(
		'title' => array(
			'type' 		 => 'VARCHAR',
			'constraint' => '200'
		),
		'body'  	 => array( 'type' => 'TEXT' ),
		'created_at' => array( 'type' => 'DATETIME' ),
		'updated_at' => array( 'type' => 'DATETIME' )
	));
	$CI->dbforge->add_field('id');
	
	$CI->dbforge->create_table('posts');
}

function migration_1_down($CI) {
	$CI->dbforge->drop_table('posts');
}