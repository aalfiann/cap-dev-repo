<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\SimpleCache as SimpleCache;
use \classes\JSON as JSON;

    // GET example api to show all data role
    $app->get('/', function (Request $request, Response $response) {
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(3600)){
            $datajson = SimpleCache::load();
        } else {
            $data = [
                'status' => 'success',
                'code' => '200',
                'welcome' => 'Hello World, here is the CAP Express API for development use.',
                'message' => 'To use our API make sure You already have a credential to login or an API Key.',
                'info' => [
                    'webmaster' => 'M ABD AZIZ ALFIAN (aalfiann@gmail.com)',
                    'documentation' => 'The documentation about this API is on our blogs.'
                ]
            ];
            $blacklistparam = ["&_=","&query=","&search=","token","apikey","api_key","time","timestamp","time_stamp","etag","key","q","s","k","t"];
            $datajson = SimpleCache::save(JSON::encode($data,true,true),null,$blacklistparam);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200);
    });