<?php
// Session start
session_start();

// Config File
require_once 'config.php';

// Helpers File
require_once 'helpers/system_helper.php';


// Autoloader
function __autoload($class_name){
	require_once 'lib/'.$class_name. '.php';
}
