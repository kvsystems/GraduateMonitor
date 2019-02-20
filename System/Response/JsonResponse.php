<?php
namespace Evie\Monitor\System\Response;

/**
 * Class JsonResponse
 * Implements json response.
 * @package Evie\MonitorController\System\Response
 */
class JsonResponse implements IResponse {

    public function output()    {
        echo 'Its ok' . PHP_EOL;
    }

}