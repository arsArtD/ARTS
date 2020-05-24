

阅读下文有感： 

https://ggbaker.ca/prog-langs/content/go-concurrency.html

代码段1：
```
type operType func(float64) float64

func SequentialMap(op operType, values []float64) []float64 {
	result := make([]float64, len(values))
	for pos, val := range values {
		result[pos] = op(val)
	}
	return result
}
```

代码段2：
```
func GoroutineMap(op operType, values []float64) []float64 {
	result := make([]float64, len(values))
	wg := sync.WaitGroup{}
	wg.Add(len(values))
	for pos, val := range values {
		go func(pos int, val float64) {
			defer wg.Done()
			result[pos] = op(val)
		}(pos, val)
	}
	wg.Wait()
	return result
}
```

代码段3：
```
func ChunkedMap(op operType, values []float64) []float64 {
	const chunkSize = 1000
	length := len(values)
	result := make([]float64, length)
	wg := sync.WaitGroup{}
	for p := 0; p < length; p += chunkSize {
		wg.Add(1)
		go func(start int) {
			defer wg.Done()
			end := min(start+chunkSize, length)
			for pos, val := range values[start:end] {
				result[start+pos] = op(val)
			}
		}(p)
	}
	wg.Wait()
	return result
}
```


执行结果：

That calls a smaller number of goroutines, and we see the speedup we expect (with 4 cores/​8 threads):  

代码段1  	     300	   6348386 ns/op  
代码段2   	      50	  31267035 ns/op  
代码段3      	1000	   1594102 ns/op  
