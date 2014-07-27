<?php

/**
 * The second example - using of Cli class.
 * 
 * Please run this class with this command:
 * 
 * 		php cli.php second-example --my-parameter="Is here! Yey"
 * 
 * 
 */

Log::debug('My parameter: ' . Cli::getParameter('my-parameter'));

Log::debug('DONE');
