<?php
namespace Evie\Monitor\System\Controller;

use Evie\Monitor\System\Response\IResponse;
use Evie\Monitor\System\Response\ResponseFactory;

/**
 * Class Responder.
 * Generates the required response types.
 * @package Evie\MonitorController\System\Controller
 */
class Responder {

    /**
     * Responder type
     * @var string
     */
    private $_type;

    public  function __construct(string $type = 'default')  {
        $this->_type = $type;
    }

    /**
     * Gets error response.
     * @return IResponse
     */
    public function error() {
        return ResponseFactory::response($this->_type);
    }

    /**
     * Gets the desired type of response.
     * @return IResponse
     */
    public function success() : IResponse   {
        return ResponseFactory::response($this->_type);
    }

}