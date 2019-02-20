<?php
namespace Evie\Monitor\System\Middleware\Base;

use Evie\Monitor\System\Request\Request;

/**
 * Interface IHandler.
 * Management of types of intermediate treatments.
 * @package Evie\MonitorController\System\Middleware\Base
 */
interface IHandler {

    public function handle(Request $request);

}