<?php

class Report {
	private $title = null;
	private $messages = array();
	
	public function __construct($title) {
		$this->title = $title;
	}
	
	public function addMessage($level, $message, $howToFix = null) {
		$this->messages[] = array(
			'message' => $message,
			'fix' => $howToFix,
			'level' => $level // might be warning, info, fatal
		);
	}
	
	public function hasMessages() {
		return sizeof($this->messages);
	}
	
	public function getMessages() {
		return $this->messages;	
	}
	
	public function getTitle() {
		return $this->title;
	}
}

$reports = array(); // the array of Report class instances

// first, check configs
$report = new Report('config.application.php');
if (!is_file('config.application.php')) {
	if (is_file('sample.config.application.php')) {
		$report->addMessage('fatal', 'Missing config.application.php', 'You have sample.config.application.php so make a copy or rename this file to config.application.php and set all required params there.');
	} else {
		$report->addMessage('fatal', 'Missing config.application.php', 'You don\'t even have sample file for application config, so you\'ll have to search for solution onlie.');
	}
} else {
	$config = require_once 'config.application.php';
	if (!is_array($config) && $config == 1) {
		$report->addMessage('fatal', 'config.application.php doesn\'t return config array', 'Please check config.application.php and make sure that config returns array of config parameters');
	} else {
		if (!is_dir($config['application_path'])) {
			$report->addMessage('fatal', 'application_path doesn\'t exist', "Please create directory <b>{$config['application_path']}</b> or update your config");
		}
		if (!is_dir($config['storage_path'])) {
			$report->addMessage('warning', 'Storage directory doesn\'t exist', "Please create directory <b>{$config['storage_path']}</b> or update your config");
		}
	}
}


$reports['application'] = $report;



// check database
$report = new Report('Database config');
if (!is_file('config.database.php')) {
	if (is_file('database.config.sample.php')) {
		$report->addMessage('fatal', 'Missing config/database.php', 'You have config/database.php so make a copy or rename this file to config/database.php and set all required params there.');
	} else {
		$report->addMessage('fatal', 'Missing config/database.php', 'You don\'t even have sample file for database config, so you\'ll have to search for solution onlie.');
	}
}

$reports['database'] = $report;



// check mail
$report = new Report('Mail config');
if (!is_file('config.mail.php')) {
	if (is_file('sample.config.mail.php')) {
		$report->addMessage('fatal', 'Missing config.mail.php', 'You have sample.mail.application.php so make a copy or rename this file to config.mail.php and set all required params there.');
	} else {
		$report->addMessage('fatal', 'Missing config.mail.php', 'You don\'t even have sample file for mail config, so you\'ll have to search for solution onlie.');
	}
}

$reports['mail'] = $report;



// check session
$report = new Report('Session config');
if (!is_file('config.session.php')) {
	if (is_file('sample.config.session.php')) {
		$report->addMessage('fatal', 'Missing config.session.php', 'You have sample.session.application.php so make a copy or rename this file to config.session.php and set all required params there.');
	} else {
		$report->addMessage('fatal', 'Missing config.session.php', 'You don\'t even have sample file for session config, so you\'ll have to search for solution onlie.');
	}
}

$reports['session'] = $report;



// check cache
$report = new Report('Cache config');
if (!is_file('config.cache.php')) {
	if (is_file('sample.config.cache.php')) {
		$report->addMessage('fatal', 'Missing config.cache.php', 'You have sample.cache.application.php so make a copy or rename this file to config.cache.php and set all required params there.');
	} else {
		$report->addMessage('fatal', 'Missing config.cache.php', 'You don\'t even have sample file for cache config, so you\'ll have to search for solution onlie.');
	}
}

$reports['cache'] = $report;




if (!isset($_SERVER['HTTP_HOST'])) {
	// it is CLI, no HTML output!
	
	echo "\nConfiguration Test Report\n";
	echo str_repeat('=', 30) . "\n";
	
	foreach ($reports as $report) {
		echo "{$report->getTitle()}";
		if ($report->hasMessages()) {
			echo "\n\n";
			foreach ($report->getMessages() as $message) {
				echo "\t" . strtoupper($message['level']) . ":\t{$message['message']} -- {$message['fix']}\n";
			}
			echo "\n";
		} else {
			echo " ... all good :)\n";
		}
	}
	
	exit(0);
}

?><!DOCTYPE html>
<html>
  <head>
    <title>Configuration test results!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <div class="container" style="margin-top: 20px;">
    	<div class="col-md-12">
    		<div class="jumbotron">
			  <h1>Configuration test results!</h1>
			  <p><?= $_SERVER['HTTP_HOST'] ?></p>
			  <p><a onclick="window.location.reload()" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-refresh"></span> Retry</a></p>
			</div>
    	</div>
    	
    	<?php foreach ($reports as $report) : ?>
    	<div class="col-md-12">
    		<div class="panel panel-<?= $report->hasMessages() ? 'danger' : 'success' ?>">
    			<div class="panel-heading"><h3 class="panel-title"><?= $report->getTitle() ?></h3></div>
	    		<div class="panel-body">
	    			<?php if ($report->hasMessages()) : ?>
	    			<?php foreach ($report->getMessages() as $message) : ?>
	    				<blockquote><p><?= $message['message'] ?></p><small><?= $message['fix'] ?></small></blockquote>
    				<?php endforeach; else : ?>
    				<span class="glyphicon glyphicon-ok-circle"></span> All good
    				<?php endif; ?>
	    		</div>
    		</div>
    	</div>
    	<?php endforeach; ?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  </body>
</html>