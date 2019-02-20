<?php
namespace Evie\Monitor\System\Request;

/**
 * Class RequestFactory.
 * Reads a request of a different type.
 * @package Evie\MonitorController\System\Request
 */
class RequestFactory {

    const WEB = 'fpm-fcgi';
    const CLI = 'cli';

    /**
     * Reads a query by type.
     * @return Request
     */
    public static function request() : Request {
        switch(PHP_SAPI) {
            case self::WEB:
                $request = new HttpRequest();
                break;
            case self::CLI:
                $request = new ShellRequest(["m:"]);
                break;
            default:
                $request = new DefaultRequest();
                break;
        }
        return $request;
    }

}