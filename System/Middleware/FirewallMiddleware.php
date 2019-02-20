<?php
namespace Evie\Monitor\System\Middleware;

use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;

class FirewallMiddleware extends Middleware {

    public function handle(Request $request)   {
        echo 'FIREWALL_ENABLED' . PHP_EOL;
    }
}