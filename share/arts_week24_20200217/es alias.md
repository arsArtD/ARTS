

# 创建alias

```
POST /_aliases
{
  "actions": [
    {
      "add": {
        "index": "my_index",
        "alias": "my_index_alias"
      }
    }
  ]
}
```


# 创建带filter的alias 
```
POST /_aliases
{
  "actions": [
    {
      "add": {
        "index": "my_index",
        "alias": "my_index__teamA_alias",
        "filter":{
            "term":{
                "team":"teamA"
            }
        }
      }
    },
    {
      "add": {
        "index": "my_index",
        "alias": "my_index__teamB_alias",
        "filter":{
            "term":{
                "team":"teamB"
            }
        }
      }
    },
    {
      "add": {
        "index": "my_index",
        "alias": "my_index__team_alias"
      }
    }
  ]
}
```
