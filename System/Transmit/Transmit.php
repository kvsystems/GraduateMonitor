<?php
namespace Evie\Monitor\System\Transmit;

use Evie\Monitor\System\Request\Request;

/**
 * Class Transmit.
 * @package Evie\Monitor\System\Transmit
 */
abstract class Transmit {

    /**
     * Application request.
     * @var $request Request
     */
    protected $request;

    /**
     * Data to transmit.
     * @var $data array
     */
    protected $data = [];

    /**
     * Remote host.
     * @var string
     */
    protected $host;

    /**
     * Prepares query.
     * Transmit constructor.
     * @param Request $request
     * @param string $host
     * @param array $data
     */
    public function __construct(Request $request, string $host, array $data = [])   {
        $this->request = $request;
        $this->data    = $data;
        $this->host    = $host;
    }

    /**
     * @param string $method
     * @param Request $request
     * @param string $host
     * @param array $data
     * @return Transmit
     */
    public static function create(string $method, Request $request, string $host, array $data = []) : Transmit {
        $class = __NAMESPACE__ . '\\' . ucfirst($method) . 'Transmit';
        return new $class($request, $host, $data);
    }

    /**
     * Checks answer curl.
     * @param resource $curl
     * @return bool
     */
    protected function success($curl)  : bool  {
        return is_resource($curl) && curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200 ? true : false;
    }

    /**
     * Sends query.
     * @return bool
     */
    public abstract function send() : bool;
}