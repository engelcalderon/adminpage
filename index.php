<?php

define('URL', "http://localhost/adminpage/");

define('ROOT', __DIR__);
define('CORE', ROOT . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
define('VIEW', ROOT . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODEL', ROOT . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . DIRECTORY_SEPARATOR . 'controller'. DIRECTORY_SEPARATOR);
define('SRC', ROOT . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
$modules=[URL,ROOT,CORE,VIEW,MODEL,CONTROLLER,SRC];

set_include_path(get_include_path() . PATH_SEPARATOR . implode (PATH_SEPARATOR, $modules));
spl_autoload_register('spl_autoload', false);

new App;

?>