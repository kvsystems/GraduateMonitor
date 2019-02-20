<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class DefaultKey
 * @package Evie\MonitorController\System\Request\Keys
 */
class DefaultKey extends GenericKey {

    /**
     * Sets default bool key.
     * @param string $value
     */
    public function handle(string $value) {
        $this->value = false;
    }

}