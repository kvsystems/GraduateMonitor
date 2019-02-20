<?php
namespace Evie\Monitor\System\Response;

class ResponseFactory {

    const JSON    = 'json';
    const DEFAULT = 'default';

    /**
     * Reads a query by type.
     * @param array $options
     * @return IRequest
     */
    public static function response(string $type) : IResponse {
        switch($type) {
            case self::JSON:
                $response = new JsonResponse();
                break;
            case self::DEFAULT:
                $response = new DefaultResponse();
                break;
            default:
                $response = new DefaultResponse();
                break;
        }
        return $response;
    }


}