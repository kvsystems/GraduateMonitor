<?php
namespace Evie\Monitor\System\Middleware;

use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Response\IResponse;

/**
 * Class LicenseMiddleware
 * @package Evie\Monitor\System\Middleware
 */
class LicenseMiddleware extends Middleware {

    /**
     * Handles license middleware.
     * @return IResponse
     */
    public function handle() : IResponse  {
        $response = $this->next->handle();
        return $response;
    }
}