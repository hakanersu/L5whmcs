<?php namespace Xuma\Whmcs;

use Exception;
use Httpful\Http;
class WhmcsHandler{
    public function test()
    {
        $uri = 'https://github.com/api/v2/xml/user/show/nategood';

        $response = Request::get($uri)  // Will parse based on Content-Type
        ->expectsXml()              // from the response, but can specify
        ->send();                   // how to parse via expectsXml too.

        echo "{$request->body->name} joined GitHub on " .
            date('M jS', strtotime($request->body->{'created-at'})) ."\n";
    }
    
}