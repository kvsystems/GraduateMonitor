<?php
namespace Evie\Monitor\System\Controller;

use Evie\Monitor\System\Monitor\MonitorService;
use Evie\Monitor\System\Response\IResponse;

class MonitorController {

    /**
     * Monitor service.
     * @var $_service MonitorService
     */
    private $_service;

    /**
     * Application responder.
     * @var $_responder Responder
     */
    private $_responder;

    /**
     * Sets service and responder.
     * MonitorController constructor.
     * @param MonitorService $service
     * @param Responder $responder
     */
    public function __construct(MonitorService $service, Responder $responder)   {
        $this->_service   = $service;
        $this->_responder = $responder;
    }

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
    public function polling() : IResponse {
         while(true) $this->_service->pollTarget();
    }

}