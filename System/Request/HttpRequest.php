<?php
namespace Evie\Monitor\System\Request;

/**
 * Class HttpRequest.
 * HTTP request processing.
 * @package Evie\MonitorController\System\Request
 */
class HttpRequest implements IRequest {

    /**
     * Request options
     * @var array
     */
    private $_options = [];

    /**
     * HttpRequest constructor.
     * Handles HTTP request.
     * @param array $options
     */
    public function __construct(array $options = [])   {
        $this->_options = $options;
        $this->_parseMethod();
        $this->_parsePath();
        $this->_parseParams();
        $this->_parseHeaders();
        $this->_parseBody();
    }

    public function getParams() {

    }

    /**
     * Handles request method.
     */
    private function _parseMethod() {

    }

    /**
     * Handles request path.
     */
    private function _parsePath()   {

    }

    /**
     * Handles request parameters.
     */
    private function _parseParams() {

    }

    /**
     * Handle request headers.
     */
    private function _parseHeaders()    {

    }

    /**
     * Handles request body.
     */
    private function _parseBody()   {

    }

}