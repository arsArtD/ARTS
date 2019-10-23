


go进行测试很简单，比如如下文件：  


jsons_test.go  
```
package structs

import (
	"testing"
	"encoding/json"
)

//这里对应的 N 和 A 不能为小写，首字母必须为大写，这样才可对外提供访问，具体 json 匹配是通过后面的 tag 标签进行匹配的，与 N 和 A 没有关系
//tag 标签中 json 后面跟着的是字段名称，都是字符串类型，要求必须加上双引号，否则 golang 是无法识别它的类型
type Person struct {
	NameAlias string `json:"name"`
	AgeAlias int `json:"age,omitempty"`
}

func TestStruct2Json1(t *testing.T) {
	jsonStr := `
    {
        "name":"liangyongxing",
        "age":12
    }
    `
	var person Person
	json.Unmarshal([]byte(jsonStr), &person)
	t.Log(person.NameAlias)
}


func TestStruct2json2(t *testing.T) {
	p := Person{
		NameAlias: "liangyongxing",
		AgeAlias: 29,
	}
	t.Logf("Person结构体打印的结果:%v", p.AgeAlias)

	jsonBytes, err := json.Marshal(p)
	if err != nil {
		t.Fatal(err)
	}
	t.Logf("转为为json串的打印结果:%s", string(jsonBytes))
}
```
