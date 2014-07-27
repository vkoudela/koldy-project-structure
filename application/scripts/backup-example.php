<?php
/**
 * This is just example script that could be executed in CLI environment or
 * by cron job. To execute this script, open terminal and go to the public
 * folder of this project and then execute this:
 * 
 * 		php cli.php backup-example
 * 
 * If you want this script to be executed by cron job, then you'll probably
 * have to call this script by the standard unix pattern:
 * 
 * 		/path/to/php/intepreter /path/to/cli.php script-name
 * 
 * So, it might be like this:
 * 
 * 		/usr/bin/php /path/to/project/public/cli.php backup-example
 */


// and now, do whatever you want


// all classes from framework and your project are available in this moment
// so feel free to use it

Log::debug('Backup example is DONE!');

