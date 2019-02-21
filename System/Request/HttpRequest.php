<?php
namespace Evie\Monitor\System\Request;

/**
 * Class HttpRequest.
 * HTTP request processing.
 * @package Evie\MonitorController\System\Request
 */
class HttpRequest extends Request {

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

    public function handle()    {

    }
}