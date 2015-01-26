<?php namespace Xuma\Whmcs;

use Exception;
// TODO : Extract client methods to own class.
class WhmcsHandler extends WhmcsConnector{

    /**
     * @param null $params
     * @return mixed
     */
    public function getClients($params=null)
    {
        $response= $this->getJson('getclients',$params);

        return $response->body->clients->client;
    }

    /**
     * @param $identity
     * @param array $params
     * @return mixed
     */
    public function getClientsDetails($identity,$params=[])
    {
        is_int($identity) ? ($params['clientid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('getclientsdetails',$params);

        return $response->body;
    }

    /**
     * @param $id
     * @return bool
     */
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

    /**
     * @param $id
     * @param array $params
     * @return bool
     */
    public function getClientsDomains($id,$params=[])
    {
        $params['clientid']=$id;

        $response= $this->getJson('getclientsdomains',$params);

        if($response->body->totalresults>0)
        {
            return $response->body->domains->domain;
        }

        return false;
    }

    /**
     * @param $identity
     * @param array $params
     * @return mixed
     */
    public function getClientsPassword($identity,$params=[])
    {
        is_int($identity) ? ($params['userid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('getclientpassword',$params);

        return !$response ?: $response->body->password;
    }

}