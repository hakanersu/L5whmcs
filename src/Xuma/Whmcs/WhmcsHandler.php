<?php namespace Xuma\Whmcs;

use Exception;

class WhmcsHandler extends WhmcsConnector{


    public function getClients($params=null)
    {
        $response= $this->getJson('getclients',$params);

        return $response->body->clients->client;
    }

    public function getClientsDetails($identity,$params=[])
    {
        is_int($identity) ? ($params['clientid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('getclientsdetails',$params);

        return $response->body;
    }
    
    public function getClientsProducts($id)
    {
        $params['clientid']=$id;

        $response= $this->getJson('getclientsproducts',$params);

        if($response->body->totalresults>0)
        {
            return $response->body->products;
        }

        return false;
    }

    public function getClientsDomains($id)
    {
        $params['clientid']=$id;

        $response= $this->getJson('getclientsdomains',$params);

        if($response->body->totalresults>0)
        {
            return $response->body->domains->domain;
        }

        return false;
    }
}