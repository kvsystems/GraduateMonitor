<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

use Evie\Monitor\System\Service\Monitor\Background\BackgroundProcess;

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

        $stop      = $process->stop();
        $processes = $process->processes();
        $watcher   = $process->watch();
        $current   = $process->watch();

        if(!empty($watcher)) {
            $process = new BackgroundProcess($watcher[0]);
            $process->stop();
        }

        $subProcess = new BackgroundProcess();
        $command = 'php ' . ROOT_DIR . 'index.php -m monitor -r monitor/watch -l ';
        $command .= implode(',', $processes);
        $command .= ' -h ' . implode(',', $current);

        $subProcess->run($command);

        return $stop;
    }

    /**
     * Gets process identifier.
     * @return int
     */
    public function pid(): int  {
        return 0;
    }

}