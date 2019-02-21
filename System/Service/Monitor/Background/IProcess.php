<?php
namespace Evie\Monitor\System\Monitor\Background;

/**
 * Interface IProcess.
 * Manages the launch command.
 * @package Evie\MonitorController\System\Background
 */
interface IProcess {

    /**
     * Runs a command in the shell.
     * @param string $command
     * @return int
     */
    public function run(string $command = '') : int;

}