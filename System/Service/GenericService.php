<?php
namespace Evie\Monitor\System\Service;

use Evie\Monitor\System\Request\Request;

/**
 * Class GenericService
 * @package Evie\Monitor\System\Controller
 */
abstract class GenericService {

    /**
     * Application request.
     * @var $request Request
     */
    protected $request;

    /**
     * Sets application request.
     * GenericService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)   {
        $this->request = $request;
    }

    /**
     * Creates service.
     * @param string $name
     * @param Request $request
     * @return GenericService
     */
    public static function service(string $name, Request $request) : GenericService {
        $service = str_replace('Service', '', $name);
        $class = __NAMESPACE__ . "\\$service\\" . $name;
        return new $class($request);
    }
}