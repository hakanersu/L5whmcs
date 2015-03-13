<?php namespace Xuma\Whmcs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Xuma\Whmcs\Traits\Clients;
use Xuma\Whmcs\Traits\Invoices;
use Xuma\Whmcs\Traits\Tickets;
use Xuma\Whmcs\Traits\Orders;

class WhmcsHandler{
    use Clients,Tickets,Invoices,Orders;

    protected $client;

    public function __construct(Client $client){
        $this->client = $client;
    }

    /**
     * Make a request to whmcs api.Some whmcs response not working as expected.
     *
     * @param $action
     * @param null $params
     * @return bool
     */
    public function getJson($action,$params=NULL)
    {
        $data=[
            'action'=>$action,
            'responsetype'=>'json'
        ];

        $data = ($params===NULL) ?: array_merge($data,$params);

        try{
            $request = $this->client->createRequest('POST',$this->dataUrl(),[
                'headers' => ['User-Agent' =>\Config::get('whmcs.user_agent')],
                'body'=>$data
            ]);

            $response = $this->client->send($request);

            $data = (object)$response->json();

            return ($data->result=="success") ? $data : false;
        }
        catch (ClientException $e)
        {
            return false;
        }
    }

    /**
     * Generate Whmcs api request url.
     *
     * @param $data
     * @return string
     */
    public function dataUrl()
    {
        return  \Config::get('whmcs.url')."?".http_build_query(array_merge([
            'username'=>\Config::get('whmcs.username'),
            'password'=> md5(\Config::get('whmcs.password'))
        ]));
    }
}