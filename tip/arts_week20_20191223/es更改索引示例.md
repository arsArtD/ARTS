
临时方案： 旧索引数据删除，新建一个有分词器的索引

curl -X PUT \
  http://root:olJoIkoguemMzbxf7CYHCp8p9UHziD4k@39.105.72.1:10200/nwn-package \
  -H 'Accept: */*' \
  -H 'Accept-Encoding: gzip, deflate' \
  -H 'Authorization: Basic cm9vdDpvbEpvSWtvZ3VlbU16YnhmN0NZSENwOHA5VUh6aUQ0aw==' \
  -H 'Cache-Control: no-cache' \
  -H 'Connection: keep-alive' \
  -H 'Content-Length: 447' \
  -H 'Content-Type: application/json' \
  -H 'Host: 39.105.72.1:10200' \
  -H 'Postman-Token: 603f341d-ccfc-4a81-bc8f-279e3f783a17,d0759478-6d4e-4145-aae6-8244563c90ff' \
  -H 'User-Agent: PostmanRuntime/7.20.1' \
  -H 'cache-control: no-cache' \
  -d '{
  "settings": {
    "index": {
      "number_of_shards": "5",
      "number_of_replicas": "1"
    },
    "analysis":{
            "analyzer":{
                    "comma_analyzer":{
                            "type":"pattern",
                            "pattern":","
                    }
            }
    }
  },
  "mappings":{
        "nwn-package":{
                "properties":{
                        "relation_template_id":{
                                "type": "text",
                                "analyzer":"comma_analyzer",
                                "search_analyzer":"comma_analyzer"
                        }
                }
        }
  }
}'
