<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class ModeKey
 * @package Evie\MonitorController\System\Request\Keys
 */
class ModeKey extends GenericKey {

    /**
     * Available mode key values
     * @var $_avail array
     */
    private $_avail = ['monitor'];

    /**
     * Handle mode key value
     * @param string $value
     */
    public function handle(string $value) {
        $this->value = in_array($value, $this->_avail) ? $value : false;
    }

}