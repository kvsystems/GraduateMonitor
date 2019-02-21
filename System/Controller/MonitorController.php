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
        return $this->_service->startService()
            ? $this->_responder->error()
            : $this->_responder->success();
    }

    /**
     * Stops the monitor background application
     * @return IResponse
     */
    public function stop() : IResponse {
        return $this->_service->stopService()
            ? $this->_responder->error()
            : $this->_responder->success();
    }

    /**
     * The monitor background cycle.
     */
    public function polling() {
         while(true) $this->_service->pollTarget();
    }

    /**
     * Default controller action.
     * @return IResponse
     */
    public function default(): IResponse    {
        return new DefaultResponse();
    }
}