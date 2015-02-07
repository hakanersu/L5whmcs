<?php namespace Xuma\Whmcs\Traits;

trait Tickets {
    /**
     * Post a ticket reply
     * @param $params
     * @return bool
     */
    public function postTicketReply($params)
    {
        $response= $this->getJson('addticketreply',$params);

        return $response->result=="success" ? true :false;
    }

    /**
     * Create a new ticket.
     * @param $params
     * @return bool
     */
    public function postNewTicket($params)
    {
        $response= $this->getJson('openticket',$params);

        return $response->result=="success" ? true :false;
    }

}