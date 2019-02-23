<?php
namespace Evie\Monitor\System\Middleware\Base;

use Evie\Monitor\System\Response\IResponse;

/**
 * Interface IHandler.
 * Management of types of intermediate treatments.
 * @package Evie\MonitorController\System\Middleware\Base
 */
interface IHandler {

    /**
     * Handles middleware.
     * @return IResponse
     */
    public function handle() : IResponse;

}