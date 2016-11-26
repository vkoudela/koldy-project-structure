<?php

/**
 * Config(s) for sending mails. The first block will always be default for 
 * sending mail. So, if you want to send mail using default config, use:
 * 
 * 		Mail::create()
 *   		->to('your@mail.com')
 *     		->from('server@mail.com')
 *       	->subject('Mail subject')
 *        	->body('Your mail body')
 *         	->send();
 * 
 * If you want to send mail using "backup" config, then:
 * 
 * 		Mail::create('backup')
 *   		->...
 *         	->send();
 * 
 * @link http://koldy.net/docs/mail
 */
return array(

	/**
	 * This won't actually send e-mail. It'll just simulate sending by
	 * writing an e-mail to file
	 *
	 * @link http://koldy.net/docs/mail/file
	 */
	'file' => array(
		'enabled' => true,
		'driver_class' => '\Koldy\Mail\Driver\File'
	),

	/**
	 * This won't actually send e-mail. It'll just simulate sending by
	 * printing log message. This is good in development environment.
	 *
	 * @link http://koldy.net/docs/mail/simulate
	 */
	'simulate' => array(
		'enabled' => true,
		'driver_class' => '\Koldy\Mail\Driver\Simulate'
	),

	/**
	 * Driver for using internal mail() function
	 * 
	 * @link http://koldy.net/docs/mail/mail
	 */
	'sendmail' => array(
		'enabled' => true,
		'driver_class' => '\Koldy\Mail\Driver\Mail'
	),

	/**
	 * PHPMailer configuration
	 * 
	 * @link http://koldy.net/docs/mail/phpmailer
	 */
	'phpmailer' => array(
		'enabled' => true,
		'driver_class' => '\Koldy\Mail\Driver\PHPMailer',

		'options' => array(
			'type' => 'smtp', // "smtp" or "mail"
			'host' => 'localhost',
			'port' => 25,
			'username' => null,
			'password' => null,
			'secure' => false
		)
	)

);
