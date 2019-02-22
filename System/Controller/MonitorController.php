<?php
namespace Evie\Monitor\System\Controller;

use Evie\Monitor\System\Config;
use Evie\Monitor\System\Middleware\Router\IRouter;
use Evie\Monitor\System\Monitor\MonitorService;
use Evie\Monitor\System\Response\DefaultResponse;
use Evie\Monitor\System\Response\IResponse;
use Evie\Monitor\System\Service\GenericService;

class MonitorController extends GenericController {

    /**
     * Starts the monitor background application.
     * @return IResponse
     */
    public function start() : IResponse {
        return $this->service->startService()
            ? $this->responder->error()
            : $this->responder->success();
    }

    /**
     * Stops the monitor background application
     * @return IResponse
     */
    public function stop() : IResponse {
        return $this->service->stopService()
            ? $this->responder->error()
            : $this->responder->success();
    }

    /**
     * Restarts the monitor background application
     * @return IResponse
     */
    public function restart() : IResponse {
        return $this->service->restartService()
            ? $this->responder->error()
            : $this->responder->success();
    }

    /**
     * Runs processes observer.
     * @return IResponse
     */
    public function observer() : IResponse {
        $runner = $this->service->on();
        return ($runner)
            ? $this->responder->error()
            : $this->responder->success();
    }

    /**
     * Stops processes and observer.
     * @return IResponse
     */
    public function off() : IResponse  {
        return $this->service->disable()
            ? $this->responder->error()
            : $this->responder->success();
    }

    /**
     * The monitor background cycle.
     */
    public function polling() : IResponse {
        return $this->service->pollTarget()
            ? $this->responder->error()
            : $this->responder->success();
    }

    /**
     * Stops processes and observer.
     * @return IResponse
     */
    public function watcher() : IResponse  {
        return $this->service->watch()
            ? $this->responder->error()
            : $this->responder->success();
    }

    /**
     * Default controller action.
     * @return IResponse
     */
    public function default(): IResponse    {
        return new DefaultResponse();
    }

    /**
     * Gets polling frequency.
     * @return int
     */
    public function frequency() {
        return $this->_frequency;
    }
}