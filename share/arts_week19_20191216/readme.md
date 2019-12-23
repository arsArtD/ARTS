

laravel es安装使用  

# 官方文档地址： 
https://laravel.com/docs/5.8/scout  


composer create-project --prefer-dist laravel/laravel laravel_es 5.8.*  

composer require tamayo/laravel-scout-elastic    

php artisan vendor:publish--provider="Laravel\Scout\ScoutServiceProvider"  

配置 config/scout.php 中涉及到的env变量，例如：  
```
SCOUT_DRIVER=elasticsearch
SCOUT_PREFIX=es-
SCOUT_QUEUE=false
ES_HOSTS=http://127.0.0.1:9200,http://127.0.0.1:9200
ES_RETRIES=1
ES_INDEX=default
```

command:  
php artisan scout:import "App\Article"  

# usage  

## ArticleController.php
```
$res = ArticleModel::search('', function ($es, string $query, array $options) {
    $options = [
        'index' => 'article',
        'type' => 'article',
        'body' => [
            'query' => [
                'bool' => [
                    'filter' => [
                        [
                            'term' => [
                                    'product' => 4
                            ]
                        ],
                        [
                            'term' => [
                                    'id' => 3792
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];
    return $es->search($options);
})->get();
```

## ArticleModel.php:  
```
use Searchable;
        
public function searchableAs()
{
    return 'article';
}

public function toSearchableArray()
{
    $array = $this->toArray();
            
    return $array;
}

public function getScoutKey()
{
    return $this->id;
}
```
