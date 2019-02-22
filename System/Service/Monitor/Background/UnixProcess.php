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

    /**
     * Gets process IP address.
     * @return string
     */
    public function ipa(int $pid): string   {
        return shell_exec(
            'ps -aux | grep index.php | grep ' . $pid . ' | grep -oE "\b([0-9]{1,3}\.){3}[0-9]{1,3}\b"'
        );
    }
}