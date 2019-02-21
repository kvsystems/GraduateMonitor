<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

use Evie\Monitor\System\Service\Monitor\Background\BackgroundProcess;

/**
 * Class OffCommand.
 * Rejects the execution of the system command.
 * @package Evie\MonitorController\System\Command
 */
class OffCommand implements ICommand {

    /**
     * Stops all processes.
     * @return bool
     */
    public function execute(): bool {
        $process = new BackgroundProcess();
        return $process->off();
    }

    /**
     * Gets process identifier.
     * @return int
     */
    public function pid(): int  {
        return 0;
    }
}