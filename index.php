<?php
namespace Evie\Monitor;

use Evie\Monitor\System\Core;

/** Manual autoload **/
define('ROOT_DIR', realpath( dirname(__FILE__) ) . DIRECTORY_SEPARATOR);
require_once ROOT_DIR . 'System/Autoload.php';

/** Trying main script execution **/
try {
    Core::instance()
        ->init()
        ->handle()
        ->output();
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}