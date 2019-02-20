<?php
namespace Evie\Monitor\System;

/**
 * Class Config.
 * Application configuration stack.
 * @package Evie\MonitorController\System
 */
class Config {

    /**
     * Configuration stack.
     * @var array
     */
    private $_values = [];

    /**
     * Routes stack.
     * @var array
     */
    private $_routes = [];

    /**
     * Application mode.
     * @var string
     */
    private $_mode;

    /**
     * Config constructor.
     * Read configuration from "app.ini".
     */
    public function __construct()   {
        $this->_mode   = PHP_SAPI;
        $this->_values = parse_ini_file(ROOT_DIR . 'app.ini', INI_SCANNER_TYPED);
        $this->_routes = parse_ini_file(ROOT_DIR . 'routes.ini', INI_SCANNER_TYPED);
    }

    /**
     * Gets type app router.
     * @return string
     */
    public function getRouter() : string {
        return $this->_values[$this->_mode]['router'];
    }

    /**
     * Gets type app responder.
     * @return string
     */
    public function getResponder() : string {
        return $this->_values[$this->_mode]['response'];
    }

    /**
     * Gets type app middleware.
     * @return array
     */
    public function getMiddleware() : array {
        return explode(',', $this->_values[$this->_mode]['middleware']);
    }

    /**
     * Gets type app controllers.
     * @return array
     */
    public function getControllers()  : array  {
        return explode(',', $this->_values[$this->_mode]['controllers']);
    }

    /**
     * Gets application mode routes.
     * @return array
     */
    public function getRoutes() : array {
        return $this->_routes[$this->_mode];
    }

    /**
     * Gets workers limit.
     * @return int
     */
    public function getWorkers()  : int  {
        return (int) $this->_values['limits']['workers'];
    }

    /**
     * Gets pooling frequency.
     * @return int
     */
    public function getFrequency() : int  {
        return (int) $this->_values['limits']['frequency'];
    }

    /**
     * Gets hosts urls.
     * @return array
     */
    public function getHosts() : array  {
        return $this->_values['hosts'];
    }
}