<?php
namespace Evie\Monitor\System\Transmit;

/**
 * Class PutTransmit.
 * @package Evie\Monitor\System\Transmit
 */
class PutTransmit extends Transmit {

    /**
     * Sends PUT query.
     * @return bool
     */
    public function send() : bool    {
        $out = true;
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, $this->host);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->data));
            curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt ($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt ($curl, CURLOPT_TIMEOUT_MS, 900);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen(json_encode($this->data)))
            );
            $out = curl_exec($curl);

            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if($http_code != 200) $out = false;

            curl_close($curl);
        }


        return $out;
    }

}