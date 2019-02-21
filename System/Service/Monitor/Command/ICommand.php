<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

/**
 * Interface ICommand.
 * Manages the system command.
 * @package Evie\MonitorController\System\Command
 */
interface ICommand {

    /**
     * Executes a command.
     * @return bool
     */
    public function execute() : bool;

    /**
     * Gets process identifier.
     * @return int
     */
    public function pid() : int;
}