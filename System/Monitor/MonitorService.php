<?php
namespace Evie\Monitor\System\Monitor;

use Evie\Monitor\System\Monitor\Command\CommandFactory;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Transmit\Transmit;
use Evie\Monitor\System\Config;

class MonitorService {

    /**
     * Application request.
     * @var $_request Request
     */
    private $_request;

    /**
     * Remote hosts.
     * @var $hosts array
     */
    protected $hosts = [];

    /**
     * Sets request.
     * MonitorService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)   {
        $config         = new Config();
        $this->hosts    = $config->getHosts();
        $this->_request = $request;
    }

    /**
     * Executes a monitor start command.
     * @return bool
     */
    public function startService() : bool {
        $service = CommandFactory::command('start', $this->_request);
        return $service->execute()
            ? Transmit::create('post', $this->_request, $this->hosts['crud'], [$service->pid()])->send()
            : false;
    }

    /**
     * Executes a monitor stop command.
     * @return bool
     */
    public function stopService() : bool {
        $service = CommandFactory::command('stop', $this->_request);
        $result = $service->execute();
        return $result
            ? Transmit::create('post', $this->_request, $this->hosts['crud'], [$result])->send()
            : false;
    }

    /**
     * Executes a monitor restart command.
     * @return bool
     */
    public function restartService() : bool  {
        $service = CommandFactory::command('restart', $this->_request);
        return $service->execute()
            ? Transmit::create('post', $this->_request, $this->hosts['crud'], [$service->pid()])->send()
            : false;
    }

    /**
     * Polls current request target.
     * @return bool
     */
    public function pollTarget() : bool  {
        for($i = 0; $i < 100; $i++)   {
            echo 'Run: ' . $i . PHP_EOL;
            sleep(15);
        }
        exit(0);
        return false;
    }

}