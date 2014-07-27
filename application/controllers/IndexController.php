<?php

use Koldy\Log;
use Koldy\View;

class IndexController {
	
	public function indexAction() {
		return View::create('base')
			->with('text', 'This is your first page!');
	}
	
	public function testAction() {
		return 'Test OK';
	}
	
	public function logAction() {
		Log::debug('TEST from log action');
		return 'OK';
	}
}
