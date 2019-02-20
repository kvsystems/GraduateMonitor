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

    public function parameter(string $name) : GenericKey {
        return isset($this->params[$name])
            ? $this->params[$name]
            : KeysFactory::parameter('default', 'default');
    }

    public function parameters() : array {
        return $this->options;
    }

    public abstract function handle();
}