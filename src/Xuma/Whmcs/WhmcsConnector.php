<?php namespace Xuma\Whmcs;

use Httpful\Request;

class WhmcsConnector {

    /**
     * Make a request to whmcs api.Some whmcs response not working as expected.
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

        $response = Request::get($this->dataUrl($data))
            ->expectsJson()
            ->send();

        if($response->body->result!='success')
        {
            return false;
        }

        return $response;
    }

    /**
     * Generate Whmcs api request url
     * @param $data
     * @return string
     */
    public function dataUrl($data)
    {
        return  \Config::get('whmcs.url')."?".http_build_query(array_merge([
            'username'=>\Config::get('whmcs.username'),
            'password'=> md5(\Config::get('whmcs.password'))
        ],$data));
    }

}