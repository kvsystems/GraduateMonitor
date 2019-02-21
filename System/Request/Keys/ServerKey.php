<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class ServerKey
 * @package Evie\MonitorController\System\Request\Keys
 */
class ServerKey extends GenericKey {

    /**
     * Handle mode key value
     * @param string $value
     */
    public function handle(string $value) {
        $this->value = (int) $value > 0 ? $value : false;
    }
}