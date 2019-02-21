<?php
namespace Evie\Monitor\System\Middleware\Base;

use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Response\IResponse;

/**
 * Interface IHandler.
 * Management of types of intermediate treatments.
 * @package Evie\MonitorController\System\Middleware\Base
 */
interface IHandler {

    /**
     * Handles middleware.
     * @param Request $request
     * @return IResponse
     */
    public function handle() : IResponse;

}