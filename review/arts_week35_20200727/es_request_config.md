

https://www.elastic.co/guide/en/elasticsearch/client/php-api/6.x/per_request_configuration.html


# ignore http status code 

```
$client = ClientBuilder::create()->build();

$params = [
    'index'  => 'test_missing',
    'type'   => 'test',
    'client' => [ 'ignore' => [400, 404] ] 
];
echo $client->get($params);

> No handler found for uri [/test_missing/test/] and method [GET]
```


# custom query params

```
$client = ClientBuilder::create()->build();

$params = [
    'index' => 'test',
    'type' => 'test',
    'id' => 1,
    'parent' => 'abc',              // white-listed Elasticsearch parameter
    'client' => [
        'custom' => [
            'customToken' => 'abc', // user-defined, not white listed, not checked
            'otherToken' => 123
        ]
    ]
];
$exists = $client->exists($params);
```


# catch request detail(verbosity)

```
$client = ClientBuilder::create()->build();

$params = [
    'index' => 'test',
    'type' => 'test',
    'id' => 1,
    'client' => [
        'verbose' => true
    ]
];
$response = $client->get($params);
print_r($response);
```

# curl timeout

```
$client = ClientBuilder::create()->build();

$params = [
    'index' => 'test',
    'type' => 'test',
    'id' => 1,
    'client' => [
        'timeout' => 10,        // ten second timeout
        'connect_timeout' => 10
    ]
];
$response = $client->get($params);
``` 

# enable future mode

```
$client = ClientBuilder::create()->build();

$params = [
    'index' => 'test',
    'type' => 'test',
    'id' => 1,
    'client' => [
        'future' => 'lazy'
    ]
];
$future = $client->get($params);
$results = $future->wait();       // resolve the future
```

# ssl encryption 

```
$client = ClientBuilder::create()->build();

$params = [
    'index' => 'test',
    'type' => 'test',
    'id' => 1,
    'client' => [
        'verify' => 'path/to/cacert.pem'      //Use a self-signed certificate
    ]
];
$result = $client->get($params);
```
