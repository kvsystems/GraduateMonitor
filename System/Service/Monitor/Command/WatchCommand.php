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
        $process->run(
            'php ' . ROOT_DIR . 'index.php -m monitor -r monitor/watch -l ' . $this->_request->parameter('list')->value()
        );
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
}