<?php
namespace Evie\Monitor\System\Service\Monitor\Command;

use Evie\Monitor\System\Request\Keys\KeysFactory;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Service\Monitor\Background\BackgroundProcess;

/**
 * Class OnCommand.
 * Rejects the execution of the system command.
 * @package Evie\MonitorController\System\Command
 */
class OnCommand implements ICommand {

    /**
     * Processes identifiers list.
     * @var $_list array
     */
    private $_list = [];

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
     * Starts server lists
     * @return bool
     */
    public function execute(): bool {
        $servers = $this->_request->parameter('hosts')->value();
        $servers = explode(',', $servers);
        if(is_array($servers) && !empty($servers)) {
            foreach($servers as $ipa) {
                if($pid = CommandFactory::command('start', KeysFactory::parameter('ipa', $ipa)))
                    $this->_list[] = $pid;
            }
        }
        return count($this->_list) == count($servers) ? true : false;
    }

    /**
     * Gets process identifiers.
     * @return int
     */
    public function pid(): int  {
        return 0;
    }

    public function list(): string  {
        return implode( ',', $this->_list);
    }
}