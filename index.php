<?php
namespace Evie\Monitor;

use Evie\Monitor\System\Core;

define('ROOT_DIR', realpath( dirname(__FILE__) ) . DIRECTORY_SEPARATOR);
require_once ROOT_DIR . 'System/Autoload.php';

Core::instance()
    ->init()
    ->handle()
    ->output();