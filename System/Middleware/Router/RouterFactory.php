<?php
namespace Evie\Monitor\System\Middleware\Router;

/**
 * Class RouterFactory.
 * Connects the required router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
class RouterFactory {

    const MONITOR   = 'monitor';
    const HTTP      = 'http';
    const SHELL     = 'shell';

    /**
     * @param string $type
     * @return IRouter
     */
    public static function router(string $type, array $routes) : IRouter {
        switch($type) {
            case self::MONITOR:
                $response = new MonitorRouter($routes);
                break;
            case self::HTTP:
                $response = new HttpRouter($routes);
                break;
            case self::SHELL:
                $response = new ShellRouter($routes);
                break;
            default:
                $response = new DefaultRouter();
                break;
        }
        return $response;
    }

}