<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

/**
 * Class DefaultCommand.
 * Rejects the execution of the system command.
 * @package Evie\MonitorController\System\Command
 */
class DefaultCommand implements ICommand {

    /**
     * Executes default command.
     * @return bool
     */
    public function execute(): bool {
        return false;
    }

    /**
     * Gets process identifier.
     * @return int
     */
    public function pid(): int  {
        return 0;
    }

    /**
     * Gets a list of identifiers.
     * @return string
     */
    public function list(): string   {
        return '';
    }
}