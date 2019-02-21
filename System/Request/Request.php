<?php
namespace Evie\Monitor\System\Request;

use Evie\Monitor\System\Request\Keys\GenericKey;
use Evie\Monitor\System\Request\Keys\KeysFactory;

/**
 * Interface IRequest.
 * Request processing.
 * @package Evie\MonitorController\System\Request
 */
abstract class Request {

    /**
     * Request options.
     * @var $params array
     */
    protected $options = [];

    /**
     * Request parameters.
     * @var array
     */
    protected $params = [];

    /**
     * IRequest constructor.
     * Read or create request.
     * @param array $options
     */
    public function __construct(array $options = []) {
        $this->options = $options;
        $this->handle();
    }

    /**
     * Gets a request parameter.
     * @param string $name
     * @return GenericKey
     */
    public function parameter(string $name) : GenericKey {
        return isset($this->params[$name])
            ? $this->params[$name]
            : KeysFactory::parameter('default', 'default');
    }

    /**
     * Gets all request parameters.
     * @return array
     */
    public function parameters() : array {
        return $this->params;
    }

    /**
     * Gets route path.
     * @return GenericKey
     */
    public function path() : GenericKey {
        return isset($this->params['route'])
            ? $this->params['route']
            : KeysFactory::parameter('default', 'default');
    }

    /**
     * Sets a application temp parameter.
     * @param string $key
     * @param $value
     * @return bool
     */
    public function set(string $key, $value) : bool  {
        $this->params[$key] = $value;
    }

    /**
     * Handle request parameters.
     */
    public abstract function handle();
}