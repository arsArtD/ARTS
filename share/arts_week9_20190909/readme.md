

# es工具类引入  

composer.json中引入： 
"elasticsearch/elasticsearch": "^6.0",

```
use Elasticsearch\ClientBuilder;

$dsn1 = 'http:/user:password@127.0.0.1:10200';
$dsn2 = 'http:/user:password@127.0.0.2:10200';
$hosts = [$dsn1, $dsn2];
$client = ClientBuilder::create()->setHosts($hosts)->build();
$params = [];//根据实际情况填写
$result = $client->search($params);
$data = [];
//        dd($result->getHits());
if (!empty($result['hits']['total']) && $result['hits']['total'] > 0) {
    if (!empty($result['hits']['hits'])) {
        foreach ($result['hits']['hits'] as $k=>$v) {
            $data[] = $v['_source'];
        }
    }
    //$data[] = $result['hits']['hits'];
}

```
