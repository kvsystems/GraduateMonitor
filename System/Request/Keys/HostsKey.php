<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class HostsKey
 * @package Evie\MonitorController\System\Request\Keys
 */
class HostsKey extends GenericKey {

    /**
     * Handle list of hosts address value
     * @param string $value
     */
    public function handle(string $value) {
        $this->value = $value;
    }

}