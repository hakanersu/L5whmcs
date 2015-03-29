<?php namespace Xuma\Whmcs\Traits;

trait Clients {
    /**
     * Get all clients.
     *
     * @param null $params
     * @return mixed
     */
    public function getClients($params=[])
    {
        $response= $this->getJson('getclients',$params);

        return $response->clients['client'];
    }

    /**
     * Getting clients details.
     *
     * @param $identity
     * @param array $params
     * @return mixed
     */
    public function getClientsDetails($identity,$params=[])
    {
        is_int($identity) ? ($params['clientid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('getclientsdetails',$params);

        return $response;
    }

    /**
     * Getting clients products.
     *
     * @param $id
     * @return bool
     */
    public function getClientsProducts($id)
    {
        $params['clientid']=$id;

        $response= $this->getJson('cdngetclientsproducts',$params);

        return ($response->totalresults>0) ? $response->products['product'] :false;
    }

    /**
     * Get clients domains.
     *
     * @param $id
     * @param array $params
     * @return bool
     */
    public function getClientsDomains($id,$params=[])
    {
        $params['clientid']=$id;

        $response= $this->getJson('getclientsdomains',$params);

        return ($response->totalresults>0) ? $response->domains['domain'] :false;
    }

    /**
     * Get clients password.
     *
     * @param $identity
     * @param array $params
     * @return mixed
     */
    public function getClientsPassword($identity,$params=[])
    {
        is_int($identity) ? ($params['userid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('getclientpassword',$params);

        return $response ? $response->password :false;
    }


    /**
     * Get clients all tickets.
     * @param $identity
     * @param array $params
     * @return bool
     */
    public function getClientsTickets($identity,$params=[])
    {
        is_int($identity) ? ($params['clientid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('gettickets',$params);

        return $response->numreturned>0 ? $response->tickets['ticket'] : false;
    }

    /**
     * Get clients single ticket.
     * @param $ticketid
     * @return bool
     */
    public function getClientsTicket($ticketid)
    {
        $params['ticketid']=$ticketid;

        $response= $this->getJson('getticket',$params);

        return $response;
    }



}
