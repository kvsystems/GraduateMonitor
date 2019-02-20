<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class RouteKey
 * @package Evie\MonitorController\System\Request\Keys
 */
class RouteKey extends GenericKey {

    /**
     * Handle route key value
     * @param string $value
     */
    public function handle(string $value) {
        $this->value = count(explode('@', $value)) ? $value : false;
    }

}