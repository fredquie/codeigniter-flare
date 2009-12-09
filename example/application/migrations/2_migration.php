<?php
/* DATABASE MIGRATION */

function migration_2_up($CI) {
	$CI->dbforge->add_field('id');
	$CI->dbforge->create_table('comments');
}

function migration_2_down($CI) {
	$CI->dbforge->drop_table('comments');
}