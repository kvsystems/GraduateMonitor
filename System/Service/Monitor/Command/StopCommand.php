<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

use Evie\Monitor\System\Monitor\Background\BackgroundProcess;

/**
 * Class StopCommand.
 * Stops the application.
 * @package Evie\MonitorController\System\Command
 */
class StopCommand implements ICommand   {

    /**
     * Process Id.
     * @var $_pid int
     */
    private $_pid = 0;

    /**
     * Sets a process id.
     * StartCommand constructor.
     * @param int $pid
     */
    public function __construct(int $pid)   {
        $this->_pid = $pid;
    }

    /**
     * Executes default command.
     * @return bool
     */
    public function execute(): bool {
        $process = new BackgroundProcess($this->_pid);
        return $process->stop();
    }

    /**
     * Gets process identifier.
     * @return int
     */
    public function pid(): int  {
        return 0;
    }

}