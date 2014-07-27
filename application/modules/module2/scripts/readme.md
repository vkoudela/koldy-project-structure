# The /application/scripts

Scripts are tasks ready to be executed in CLI environment (or executed with Cron Jobs, what so ever).

Define your scripts in this folder. You can call your files however you want, just make sure when you run your scripts in public folder that you include the file name (without .php part) as parameter.

Example: If you have file `/application/modules/module2/scripts/backup` and you want to execute this in CLI environment, then go to your public folder and execute this command:

	php cli.php module2:backup

Or if script is called from cron job, then you'll probably want to define this kind of rule in your crontab:

	/usr/bin/php /var/www/path/to/public/cli.php module2:backup

And thats it. Enjoy!
