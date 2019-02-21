<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class KeysFactory
 * @package Evie\MonitorController\System\Request\Keys
 */
class KeysFactory {

    const MODE    = 'm';
    const ROUTE   = 'r';
    const SERVER  = 'i';
    const IP      = 'ip';

    /**
     * Gets a new parameter with value.
     * @param string $key
     * @param string $value
     * @return GenericKey
     */
    public static function parameter(string $key, string $value) : GenericKey {
        switch($key) {
            case self::MODE:
                $param = new ModeKey($value);
                break;
            case self::ROUTE:
                $param = new RouteKey($value);
                break;
            case self::SERVER:
                $param = new IdentifierKey($value);
                break;
            case self::IP:
                $param = new IpaKey($value);
                break;
            default:
                $param = new DefaultKey($value);
                break;
        }
        return $param;
    }

    /**
     * Gets a key name.
     * @param string $name
     * @return string
     */
    public static function key(GenericKey $class) : string  {
        return strtolower(
            str_replace('Key', '', str_replace(
                __NAMESPACE__ .'\\', '', get_class($class))
            )
        );
    }

}