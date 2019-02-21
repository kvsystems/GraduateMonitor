<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

use Evie\Monitor\System\Request\Request;

/**
 * Class RestartCommand.
 * Run application restart.
 * @package Evie\MonitorController\System\Command
 */
class RestartCommand implements ICommand {

    /**
     * Process Id.
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
    public function __construct(int $pid)   {
        $this->_pid = $pid;
    }

    /**
     * Executes default command.
     * @return bool
     */
    public function execute(): bool {
        if(CommandFactory::command('stop', $this->_request)->execute()) {
            $this->_pid = CommandFactory::command('start', $this->_request)->execute();
        }
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