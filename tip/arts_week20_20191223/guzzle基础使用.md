<?php
include "vendor/autoload.php";

// 此行是为了避免出现证书出错的问题，当然也可以在本地下载证书
// 参照：https://guzzle3.readthedocs.io/http-client/client.html#verify
$client = new \GuzzleHttp\Client(['verify'=>false]);

$response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

echo $response->getStatusCode(); // 200
echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

// Send an asynchronous request.
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
$promise = $client->sendAsync($request)->then(function ($response) {
    echo 'I completed! ' . $response->getBody();
});

$promise->wait();

