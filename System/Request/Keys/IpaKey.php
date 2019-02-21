<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class IpaKey
 * @package Evie\MonitorController\System\Request\Keys
 */
class IpaKey extends GenericKey {

    /**
     * Handle ip address value
     * @param string $value
     */
    public function handle(string $value) {
        $this->value = $value;
    }

}