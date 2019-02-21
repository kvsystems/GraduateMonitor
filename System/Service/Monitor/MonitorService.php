<?php
namespace Evie\Monitor\System\Service\Monitor;

use Evie\Monitor\System\Service\Monitor\Command\CommandFactory;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Service\GenericService;
use Evie\Monitor\System\Transmit\Transmit;
use Evie\Monitor\System\Config;

class MonitorService extends GenericService {

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
        parent::__construct($request);
        $config         = new Config();
        $this->hosts    = $config->getHosts();
    }

    /**
     * Executes a monitor start command.
     * @return bool
     */
    public function startService() : bool {
        $service = CommandFactory::command('start', $this->request);
        return $service->execute()
            ? Transmit::create('post', $this->request, $this->hosts['crud'], [$service->pid()])->send()
            : false;
    }

    /**
     * Executes a monitor stop command.
     * @return bool
     */
    public function stopService() : bool {
        $service = CommandFactory::command('stop', $this->request);
        $result = $service->execute();
        return $result
            ? Transmit::create('post', $this->request, $this->hosts['crud'], [$result])->send()
            : false;
    }

    /**
     * Executes a monitor restart command.
     * @return bool
     */
    public function restartService() : bool  {
        $service = CommandFactory::command('restart', $this->request);
        return $service->execute()
            ? Transmit::create('post', $this->request, $this->hosts['crud'], [$service->pid()])->send()
            : false;
    }

    /**
     * Polls current request target.
     * @return bool
     */
    public function pollTarget() : bool  {
        for($i = 0; $i < 100; $i++)   {
            echo 'Run: ' . $i . PHP_EOL;
            sleep(2);
        }
        return false;
    }

    public function observe() : bool {

    }

    /**
     * Kills all php processes.
     * @return bool
     */
    public function disable() : bool  {
        $service = CommandFactory::command('off', $this->request)->execute();
        return $service
            ? Transmit::create('post', $this->request, $this->hosts['crud'], [$service])->send()
            : false;
    }

}