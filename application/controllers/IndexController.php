<?php

use Koldy\Application;
use Koldy\Log;
use Koldy\View;

class IndexController {


	/**
	 * Handles your index page
	 * 
	 * @link http://your-site.com/
	 * @link http://your-site.com/index/index
	 */
	public function indexAction() {
		return View::create('base')
			->with('text', 'This is your first page!');
	}


	/**
	 * Just test to see of everything is setup good. Delete this method in the future.
	 * 
	 * @return string
	 * @link http://your-site.com/index/test
	 */
	public function testAction() {
		return 'Test OK';
	}


	/**
	 * Just test the log. Delete this method in the future.
	 * 
	 * @return string
	 * @link http://your-site.com/index/log
	 */
	public function logAction() {
		Log::debug('TEST from log action');
		return 'OK';
	}


	/**
	 * The robots.txt - instead of placing the robots.txt file on your server,
	 * you can serve it from here.
	 * 
	 * This will check if your app is in development mode. If it is, then it will
	 * server robots.txt which will say all bots not to index anything, otherwise,
	 * if your app is in production, then it will say: index everything.
	 * 
	 * Feel free to adjust this as you wish.
	 *
	 * @return string
	 * @link handles http://your-site.com/robots.txt
	 */
	public function robotsTxtAction() {
		header('Content-type: text/plain');
	
		if (Application::inDevelopment()) {
			return "User-agent: *\nDisallow: /";
		} else {
			return "User-agent: *\nDisallow: ";
		}
	}
}
