<?php
namespace Evie\Monitor\System\Controller;

use Evie\Monitor\System\Monitor\MonitorService;
use Evie\Monitor\System\Response\DefaultResponse;
use Evie\Monitor\System\Response\IResponse;

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
     * The monitor background cycle.
     */
    public function polling() : IResponse {
        while(true) $this->service->pollTarget();
        return $this->responder->success();
    }

    /**
     * Runs processes observer.
     * @return IResponse
     */
    public function observer() : IResponse {
        return $this->service->on() && $this->service->observe()
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
     * Stops processes and observer.
     * @return IResponse
     */
    public function watcher() : IResponse  {
        while(true) $this->service->watch();
        return $this->responder->success();
    }

    /**
     * Default controller action.
     * @return IResponse
     */
    public function default(): IResponse    {
        return new DefaultResponse();
    }
}