<?php
namespace Evie\Monitor\System\Request\Keys;

/**
 * Class GenericKey.
 * @package Evie\MonitorController\System\Request\Keys
 */
abstract class GenericKey {

    /**
     * Parameter value.
     * @var string
     */
    protected $value;

    /**
     * Sets parameter value.
     * KeyFactory constructor.
     * @param string $value
     */
    public function __construct(string $value) {
        $this->handle($value);
    }

    /**
     * Gets parameter value.
     * @return string
     */
    public function value() : string {
        return $this->value;
    }

    /**
     * Handle parameter value.
     * @param string $value
     */
    public abstract function handle(string $value);
}