<?php namespace Xuma\Whmcs;

use Exception;

class WhmcsHandler extends WhmcsConnector{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getClients($params=null)
    {
        $response= $this->getJson('getclients',$params);
        return $response->body->clients->client;
    }
    public function getClientsDetails($identity,$params=null)
    {
        if(is_int($identity))
        {
            $params['clientid'] = $identity;
        }
        else
        {
            $params['email'] = $identity;
        }
        $response= $this->getJson('getclientsdetails',$params);

        return $response->body;
    }
}