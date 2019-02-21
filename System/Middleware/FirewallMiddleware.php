<?php
namespace Evie\Monitor\System\Middleware;

use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Response\DefaultResponse;
use Evie\Monitor\System\Response\IResponse;

class FirewallMiddleware extends Middleware {

    /**
     * Handles firewall middleware.
     * @param Request $request
     * @return IResponse
     */
    public function handle(Request $request) : IResponse  {
        return new DefaultResponse();
    }
}