<?php
require '../app/util/Config.php';
require LIB . 'SwipezLogger.php';
require UTIL . 'Encrypt.php';
require UTIL . 'SMS/SMSMessage.php';
require UTIL . 'SMS/SMSSender.php';
require UTIL . 'Email/EmailMessage.php';
require UTIL . 'Email/EmailWrapper.php';
require_once('Smarty/Smarty.class.php');
require_once('Numbers/Words.php');

date_default_timezone_set("Asia/Kolkata");

//require UTIL . 'Auth.php';
//require 'util/Auth.php';
// Also spl_autoload_register (Take a look at it if you like)
require LIB . 'DBWrapper.php';
require LIB . 'Bootstrap.php';
require LIB . 'Controller.php';
require LIB . 'Model.php';
require LIB . 'View.php';
require LIB . 'Session.php';
require LIB . 'Validator.php';

require_once MODEL . 'CommonModel.php';

// Load the Bootstrap!
$bootstrap = new Bootstrap();

// Optional Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();
$bootstrap->init();

