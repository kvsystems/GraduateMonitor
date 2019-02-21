<?php
namespace Evie\Monitor\System\Service\Monitor\Background;

/**
 * Class UnixProcess
 * @package Evie\System\Background
 */
class UnixProcess implements IProcess {

    /**
     * * Runs a command in the unix shell.
     * @param string $command
     * @return int
     */
    public function run(string $command = '') : int {
        return (int) shell_exec(
            sprintf('%s %s %s 2>&1 & echo $!', $command, (false) ? '>>' : '>', '/dev/null')
        );
    }

}