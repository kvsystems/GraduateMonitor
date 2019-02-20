<?php
namespace Evie\Monitor\System\Monitor\Background;

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
}