<?php
namespace Evie\Monitor\System\Request;

use Evie\Monitor\System\Request\Keys\GenericKey;
use Evie\Monitor\System\Request\Keys\KeysFactory;

/**
 * Class ShellRequest.
 * Console request processing.
 * @package Evie\MonitorController\System\Request
 */
class ShellRequest extends Request {

    /**
     * Handle shell request parameters.
     */
    public function handle() {
        $params = getopt(implode($this->options));
        if(!empty($params) && is_array($params)) {
            foreach($params as $key => $value) {
                $obj = KeysFactory::parameter($key, $value);
                $this->params[KeysFactory::key($obj)] = $obj;
            }
        }
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
}