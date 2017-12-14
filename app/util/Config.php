<?php 
// Always provide a TRAILING SLASH (/) AFTER A PATH
define('LIB', '../app/lib/');
define('UTIL', '../app/util/');
define('MODEL', '../app/model/');
define('CONTROLLER', '../app/controller/');
define('VIEW', '../app/view/');
define('SITEDOWN', FALSE);


// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp100');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh3000miles');

//This defines the max level of slashes that need to be traversed from browser
define('MVC_MAX_LEVEL', 4);

//This section defines config key values as per the config table
define('ACTIVE_PATRON', 2);
define('VERIFIED_ADMIN', 12);
define('LEGAL_PENDING_ADMIN', 13);
define('ACTIVE_ADMIN', 12);

//This section is for mGage related URL
define("MGAGE_TIMEOUT", "10");
$baseurl = '.pgybttest.com';
ini_set('error_reporting', 0);
ini_set('session.cookie_domain', $baseurl);

//this section is for get and post form list

set_exception_handler('exception_handler');

function exception_handler($e) {

    SwipezLogger::error("Config", "Exception caught in global exception handler : " . $e->getMessage());
    header('Location: /oops');
}

