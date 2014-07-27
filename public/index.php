<?php
/**
 * Always, but *always* include the Application.php by including the full path
 * on the file system! If you know only the relative path, then resolve the
 * full path with realpath() function.
 */

include realpath(dirname(__FILE__) . '/../../FW/Koldy/Application.php');

Koldy\Application::useConfig('../application/configs/application.php');
Koldy\Application::run();
