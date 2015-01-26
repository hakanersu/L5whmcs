<?php namespace Xuma\Whmcs;
use Httpful\Request;
class WhmcsConnector {

    protected $url;

    protected $settings;

    public function __construct(){

        $this->url = \Config::get('whmcs.url');

        $this->settings= [
            'username'=>\Config::get('whmcs.username'),
            'password'=> md5(\Config::get('whmcs.password'))
        ];
    }
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
        return  $this->url."?".http_build_query(array_merge($this->settings,$data));
    }

    private function  whmcsapi_xml_parser($rawxml) {
        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $rawxml, $vals, $index);
        xml_parser_free($xml_parser);
        $params = array();
        $level = array();
        $alreadyused = array();
        $x=0;
        foreach ($vals as $xml_elem) {
            if ($xml_elem['type'] == 'open') {
                if (in_array($xml_elem['tag'],$alreadyused)) {
                    $x++;
                    $xml_elem['tag'] = $xml_elem['tag'].$x;
                }
                $level[$xml_elem['level']] = $xml_elem['tag'];
                $alreadyused[] = $xml_elem['tag'];
            }
            if ($xml_elem['type'] == 'complete') {
                $start_level = 1;
                $php_stmt = '$params';
                while($start_level < $xml_elem['level']) {
                    $php_stmt .= '[$level['.$start_level.']]';
                    $start_level++;
                }
                $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
                @eval($php_stmt);
            }
        }
        return($params);
    }
}