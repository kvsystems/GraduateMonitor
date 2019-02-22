<?php
namespace Evie\Monitor\System\Service\Monitor\Background;

/**
 * Class DefaultProcess.
 * @package Evie\System\Background
 */
class DefaultProcess implements IProcess {

    /**
     * Rejects the start of the process.
     * @param string $command
     * @return int
     */
    public function run(string $command = '') : int {
        return 0;
    }

    /**
     * Gets process IP address.
     * @return string
     */
    public function ipa(): string   {
        return '';
    }
}