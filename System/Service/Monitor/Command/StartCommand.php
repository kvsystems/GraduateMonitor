<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

use Evie\Monitor\System\Service\Monitor\Background\BackgroundProcess;
use Evie\Monitor\System\Request\Request;

/**
 * Class StartCommand.
 * Run the application.
 * @package Evie\MonitorController\System\Command
 */
class StartCommand implements ICommand {

    /**
     * Process identifier.
     * @var $_pid int
     */
    private $_pid = 0;

    /**
     * Application request.
     * @var $_request Request
     */
    private $_request;

    /**
     * Sets request.
     * StartCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)   {
        $this->_request = $request;
    }

    /**
     * Executes default command.
     * @return bool
     */
    public function execute(): bool {
        $process = new BackgroundProcess();

        $ipa = $this->_request->parameter('ipa')->value();
        $current = $process->ipa();
        $processes = $process->processes();
        $watcher = $process->watch();

        if($ipa && !in_array($ipa, $current)) {
            $process->run('php ' . ROOT_DIR . 'index.php -m monitor -r monitor/poll -a ' . $ipa);
        }

        if(!empty($watcher)) {
            $watchProcess = new BackgroundProcess($watcher[0]);
            $watchProcess->stop();
        }

        if($process->getPid() > 0) $processes[] = $process->getPid();

        $real = $process->ipa();
        $real[] = $ipa;

        $subProcess = new BackgroundProcess();

        $command = 'php ' . ROOT_DIR . 'index.php -m monitor -r monitor/watch -l ';
        $command .= implode(',', $processes);
        $command .= ' -h ' . implode(',', $real);

        $subProcess->run($command);

        $this->_pid = $process->getPid();
        return $this->_pid ? true : false;
    }

    /**
     * Gets process identifier.
     * @return int
     */
    public function pid(): int  {
        return $this->_pid;
    }

}