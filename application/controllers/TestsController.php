<?php

use Koldy\Application;
use Koldy\Log;
use Koldy\View;

/**
 * We'll show some configuration tests so you can see whats good and whats wrong
 */
class TestsController {

	private $results = array();

	/**
	 * Before calling any of the methods in this controller, first check
	 * if site is running in production mode. If yes, then we won't show
	 * any of the results or paths or what so ever. For security reasons.
	 */
	public function before() {
		if (Application::inProduction()) {
			Application::error(404);
		}
	}

	/**
	 * @link /tests
	 */
	public function indexAction() {
		return View::create('koldy-base')
			->with('title', 'Tests')
			->with('page', 'tests/base')
			->with('subpage', 'tests/not-selected');
	}

	/**
	 * Just some shorthand
	 * 
	 * @param string $title
	 * @param string $file
	 */
	private function getResultsPage($title, $file) {
		return View::create('koldy-base')
			->with('title', $title)
			->with('page', 'tests/base')
			->with('subpage', 'tests/results')
			->with('file', $file)
			->with('results', $this->results);
	}

	/**
	 * Add some test result to the page
	 * 
	 * @param string $title
	 * @param string $content
	 * @param string $color
	 */
	private function addTestResult($title, $content, $color) {
		$this->results[] = array(
			'title' => $title,
			'content' => $content,
			'color' => $color
		);
	}

	/**
	 * Inspect the configs/application.php
	 * 
	 * @link /tests/application
	 */
	public function applicationAction() {
		$file = Application::getApplicationPath('configs/application.php');
		$config = require $file;


		if (!isset($config['site_url'])) {
			$this->addTestResult('site_url', 'Is currently set to <code>null</code>. It works, but you won\'t be able to run any of your CLI scripts. Read PHP doc for more info.', 'danger');
		} else if(is_array($config['site_url'])) {
			$this->addTestResult('site_url', 'For best performance in production mode, we recommend this to be a string, not array.', 'warning');
		} else {
			$this->addTestResult('site_url', 'All good :)', 'success');
		}


		if (isset($config['assets']) && substr($config['assets'], -1, 1) == '/') {
			$this->addTestResult('assets', 'This mustn\'t have ending slash <code>(' . $config['assets'] . ')</code>! Please remove it!', 'danger');			
		} else {
			$this->addTestResult('assets', 'Not set, but its ok. You should still build your links to assets with <code>Url::asset(\'path/to/some.jpg\')</code>. <a href="http://koldy.net/docs/url#assets" target="_blank">More info!</a>', 'success');
		}


		$this->addTestResult('env', 'All good. Current value: <code>' . $config['env'] . '</code>', 'success');
		$this->addTestResult('timezone', 'All good. Current value: <code>' . $config['timezone'] . '</code>', 'success');


		foreach (array('application_path', 'public_path', 'storage_path') as $item) {
			if (!isset($config[$item])) {
				$this->addTestResult($item, 'Not set! We recommend that you define this in production. It is currently autodetected to: <code>' . Application::getConfig('application', $item) . '</code>', 'warning');

				if (!is_dir(Application::getConfig('application', $item))) {
					$this->addTestResult($item, 'Path <code>' . Application::getConfig('application', $item) . '</code> doesn\'t exists and it should be created!', 'danger');
				}
			} else {
				if (substr($config[$item], -1, 1) != '/') {
					$this->addTestResult($item, '<code>' . $item . '</code> must end with slash! Please add it! Current value is: <code>' . $config[$item] . '</code>', 'warning');
				} else {
					if (!is_dir($config[$item])) {
						$this->addTestResult($item, 'Defined path doesn\'t exists: <code>' . $config[$item] . '</code>', 'danger');
					} else {
						$this->addTestResult($item, 'All good', 'success');
					}
				}
			}
		}

		// @todo tests for modules

		if (!isset($config['key']) || $config['key'] == '_____ENTERSomeRandomKeyHere_____') {
			$this->addTestResult('key', 'Please change the <code>key</code>! Current value is: <code>' . $config['key'] . '</code>', 'error');
		} else {
			$this->addTestResult('key', 'All good!', 'success');
		}

		foreach ($config['log'] as $index => $logConfig) {
			switch ($logConfig['writer_class']) {
				case '\Koldy\Log\Writer\File':
					$options = $logConfig['options'];
					if (isset($options['path'])) {
						$path = $options['path'];
					} else {
						$path = Application::getStoragePath('log');
					}

					if (!is_dir($path)) {
						$this->addTestResult("Log config #" . ($index+1) . ": {$logConfig['writer_class']}", "Path to log folder doesn't exists: <code>{$path}</code>", 'danger');
					} else if (!is_writable($path)) {
						$this->addTestResult("Log config #" . ($index+1) . ": {$logConfig['writer_class']}", "Path to log folder is not writable: <code>{$path}</code>", 'danger');
					}
					break;
			}
		}

		return $this->getResultsPage('Test results of application.php', $file);
	}

	/**
	 * Show PHP info
	 * 
	 * @link /tests/show-phpinfo
	 */
	public function showPhpinfoAction() {
		phpinfo();
	}

}
