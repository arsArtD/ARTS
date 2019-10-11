


JSON.parse在解析对象的时候会根据key排序，需要特别注意，如果key的顺序不能变，使用如下第一种方式。  

JSON.parse('[{"name":"a","value":1},{"name":"c","value":3},{"name":"b","value":2}]')  


JSON.parse('{"1":"a","3":"c","2":"b"}')  
