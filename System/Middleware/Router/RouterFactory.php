<?php
namespace Evie\Monitor\System\Middleware\Router;
use Evie\Monitor\System\Controller\Responder;
use Evie\Monitor\System\Request\Request;


/**
 * Class RouterFactory.
 * Connects the required router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
class RouterFactory {

    const HTTP      = 'http';
    const SHELL     = 'shell';

    /**
     * Creates a type of router.
     * @param string $type
     * @param Responder $responder
     * @param array $routes
     * @return IRouter
     */
    public static function router(string $type, Responder $responder, array $routes, Request $request) : IRouter {
        switch($type) {
            case self::HTTP:
                $response = new HttpRouter($routes);
                break;
            case self::SHELL:
                $response = new ShellRouter($responder, $routes, $request);
                break;
            default:
                $response = new DefaultRouter();
                break;
        }
        return $response;
    }

}