<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

use Evie\Monitor\System\Service\Monitor\Background\BackgroundProcess;
use Evie\Monitor\System\Request\Request;

/**
 * Class WatchCommand.
 * Rejects the execution of the system command.
 * @package Evie\MonitorController\System\Command
 */
class WatchCommand implements ICommand {
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
     * Executes watch command.
     * @return bool
     */
    public function execute(): bool {
        $process = new BackgroundProcess();

        $command = 'php ' . ROOT_DIR . 'index.php -m monitor -r monitor/watch -l ';
        $command .= $this->_request->parameter('list')->value();
        $command .= ' -h ' . $this->_request->parameter('hosts')->value();

        $process->run($command);
        $this->_pid = $process->getPid();

        return $this->_pid ? true : false;
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