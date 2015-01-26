<?php namespace Xuma\Whmcs;

use Httpful\Request;

class WhmcsConnector {

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
        return $response;
    }

    public function dataUrl($data)
    {
        return  \Config::get('whmcs.url')."?".http_build_query(array_merge([
            'username'=>\Config::get('whmcs.username'),
            'password'=> md5(\Config::get('whmcs.password'))
        ],$data));
    }

}