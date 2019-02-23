<?php
namespace Evie\Monitor\System\Transmit;

/**
 * Class GetTransmit.
 * @package Evie\Monitor\System\Transmit
 */
class GetTransmit extends Transmit {

    /**
     * Sends GET query.
     * @return bool
     */
    public function send() : bool    {
        $out = true;
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, $this->host);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt ($curl, CURLOPT_TIMEOUT, 60);
            curl_setopt ($curl, CURLOPT_TIMEOUT_MS, 900);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json')
            );
            $out = curl_exec($curl);
            if(!$this->success($curl)) $out = false;
            curl_close($curl);
        }
        return $out;
    }
}