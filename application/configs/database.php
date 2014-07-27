<?php
/**
 * This array contains the list of database adapter settings so query can be executed
 * on any adapter you define here. By default, the first item in the array is always the
 * default parameter because most of the websites will need only one database to work with.
 * 
 * To be able to work on second database, simply call Db::getAdapter('backup'). If you want
 * to work with other database connection on your model, then use protected static property
 * "$connection", such as:
 * 
 * 		class User extends \Koldy\Db\Model {
 *   		protected static $connection = 'backup';
 *   	}
 * 
 * @link http://koldy.dev/docs/database/configuration
 */
return array(

	'site' => array(
		'type' => 'mysql',
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'database' => 'test',
		'persistent' => true,
		'charset' => 'utf8'
	),

	'backup' => array(
		'type' => 'mysql',
		'host' => '192.168.1.2',
		'username' => 'root',
		'password' => '',
		'database' => 'test',
		'persistent' => false,
		'charset' => 'utf8'
	)

);
