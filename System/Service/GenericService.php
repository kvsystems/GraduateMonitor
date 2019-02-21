<?php
namespace Evie\Monitor\System\Service;

use Evie\Monitor\System\Controller\GenericController;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Response\IResponse;

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
        $class = __NAMESPACE__ . ucfirst($name . 'service');
        return new $class($request);
    }
}