<?php

/**
 * Initially, the index.php will work automatically if you place Koldy Framework
 * in [your-project]/application/library/
 */
require '../application/library/Koldy/Application.php'; // full path to Koldy/Application.php

/**
 * The parameter in "useConfig" can be defined relative to this index.php
 */
Koldy\Application::useConfig(array(

	'site_url' => null, // @example: "https://your-domain.com" or array of domains including protocol

	'assets' => array( // where are your assets?
		//'static' => '/static', // so you can change later
		//'cdn' => 'http://other.domain.com'
	),

	'env' => 'DEVELOPMENT', // @example DEVELOPMENT or PRODUCTION
	'live' => false, // set to true if your app is live
	'timezone' => 'UTC', // * @link http://www.php.net/date_default_timezone_set

	'configs_path' => null, // folder where all configs are located (include ending slash), otherwise it's :application/configs

	'configs' => array( // Custom path for each config name. Overrides 'configs_path' for given name only
		//'my-config'      => '/var/my-centralized-configs/website/my-config.php'
	),

	'application_path' => null, // path to your application folder, with ending slash
	'public_path' => null, // path to your public folder, with ending slash
	'storage_path' => null, // path to your storage folder, with ending slash
	'view_path' => null, // path to your views folder, with ending slash, otherwise it's :application/views
	'additional_include_path' => null, // array of full paths on your file system
	'module_path' => null, // custom location of modules with ending slash, otherwise it's :application/modules
	'auto_register_modules' => null, // array of module names on file system
	'key' => '_____ENTERSomeRandomKeyHere_____', // Random key, 32 chars max
	'routing_class' => '\Koldy\Application\Route\DefaultRoute', // @link http://koldy.net/docs/routes

	'routing_options' => array( // @link http://koldy.net/docs/routes#configuration
		'always_restful' => false
		// 'url_namespace' => '/public-sub-folder/my-app'
	),

	'log' => array( // @link http://koldy.net/docs/log

		array( // @link http://koldy.net/docs/log/file
			'enabled' => (PHP_SAPI != 'cli'),
			'writer_class' => '\Koldy\Log\Writer\File',
			'options' => array(
				'path' => null,
				'log' => array('debug', 'notice', 'info', 'warning', 'error', 'sql', 'critical', 'alert', 'emergency'),
				'dump' => array()
			)
		),

		array( // @link http://koldy.net/docs/log/file
			'enabled' => (PHP_SAPI != 'cli'),
			'writer_class' => '\Koldy\Log\Writer\Email',
			'options' => array(
				'driver' => null, // defined in configs/mail.php
				'log' => array('warning', 'error', 'exception', 'critical', 'alert', 'emergency'),
				'send_immediately' => false, // set to true if this logger will work on CLI
				'to' => 'your@email.com'
			)
		),

		array( // @link http://koldy.net/docs/log/out
			'enabled' => (PHP_SAPI == 'cli'),
			'writer_class' => '\Koldy\Log\Writer\Out',
			'options' => array(
				'log' => array('debug', 'notice', 'info', 'warning', 'error', 'sql', 'exception', 'critical', 'alert', 'emergency'),
				'dump' => array('speed')
			)
		),

		array( // @link http://koldy.net/docs/log/db
			'enabled' => false,
			'writer_class' => '\Koldy\Log\Writer\Db',
			'options' => array(
				'log' => array('debug', 'notice', 'info', 'warning', 'error', 'sql', 'exception', 'critical', 'alert', 'emergency'),
				'connection' => null, // connection defined in database.php
				'table' => 'log'
			)
		)

	),

	//'error_handler' => function($errno, $errstr, $errfile, $errline) { // @link http://php.net/manual/en/function.set-error-handler.php
	//  Do something, but be careful. Remember that E_ERROR is not recoverable.
	//}

));

Koldy\Application::run();
