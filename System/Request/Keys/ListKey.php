<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class ListKey
 * @package Evie\MonitorController\System\Request\Keys
 */
class ListKey extends GenericKey {

    /**
     * Handle list of ip address value
     * @param string $value
     */
    public function handle(string $value) {
        $this->value = $value;
    }

}