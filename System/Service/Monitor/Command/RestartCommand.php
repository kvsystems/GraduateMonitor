<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Service\Monitor\Background\BackgroundProcess;

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
    public function __construct(int $pid, Request $request)   {
        $this->_pid = $pid;
        $this->_request = $request;
    }

    /**
     * Executes default command.
     * @return bool
     */
    public function execute(): bool {
        $ipa = $this->_request->parameter('ipa')->value();

        if($ipa && CommandFactory::command('stop', $this->_request)->execute()) {

            $process = new BackgroundProcess();
            $current = $process->ipa();

            if($ipa && !in_array($ipa, $current)) {
                $this->_pid = CommandFactory::command('start', $this->_request)->execute();
            }

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