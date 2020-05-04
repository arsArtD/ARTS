

# 编程陷阱的理解  

容易被开发者使用，程序执行的结果却出乎意料，容易产生错误的场景  

# 针对go语言，出现陷阱的原因 

* 常见的数据结构理解不到位
* Go语言本身的特点理解不到位 
* 不理解go语言的设计理念和代码组织的哲学
* 容易受到其他编程语言的而一些影响，对代码产生错误的预判  


# go语言陷阱分类：

* 数据结构细节： 切片的拷贝和扩容；map的存储和并发访问
* 闭包和循环便令的特性，协程泄露通道死锁 
* 程序与代码组织循环依赖，依赖注入 

## 数组 

所有类型的拷贝都是值拷贝 
```
package main

import "fmt"

func ChangeArray(new []int) {
	new[0] = 100
}

func main() {
	var old = []int{1,2,3}
	ChangeArray(old)
	fmt.Println(old)   // [100 2 3]
	
	new := old[1:3]
    new[0] = 99
    fmt.Println(old, new)  // [100 99 3] [99 3]
}
```

```
package main

import "fmt"

func ChangeArray(new []int) {
	new[0] = 100
}

func main() {
	var old = []int{1,2,3}
	ChangeArray(old)
	fmt.Println(old)   // [100 2 3]
	
    new = append(new, 4)
    new[0] = 99
    fmt.Println(old, new)  // 100 99 3] [99 3 4]
}
```

### 切片的底层数据结构 

```
type SliceHeader struct {
	Data uintptr   --  slice元素对应的底层数据元素的地址
	Len  int       --  代表长度，对应slice中元素的数目
	Cap  int       --  代表容量，一般是从slice的开始位置到底层数据的结尾位置的长度 
}
```

### 数组扩容 

```
func growslice(et *_type, old slice, cap int) slice {
	if raceenabled {
		callerpc := getcallerpc()
		racereadrangepc(old.array, uintptr(old.len*int(et.size)), callerpc, funcPC(growslice))
	}
	if msanenabled {
		msanread(old.array, uintptr(old.len*int(et.size)))
	}

	if cap < old.cap {
		panic(errorString("growslice: cap out of range"))
	}

	if et.size == 0 {
		// append should not create a slice with nil pointer but non-zero len.
		// We assume that append doesn't need to preserve old.array in this case.
		return slice{unsafe.Pointer(&zerobase), old.len, cap}
	}

	newcap := old.cap
	doublecap := newcap + newcap
	if cap > doublecap {
		newcap = cap
	} else {
		if old.len < 1024 {
			newcap = doublecap
		} else {
			// Check 0 < newcap to detect overflow
			// and prevent an infinite loop.
			for 0 < newcap && newcap < cap {
				newcap += newcap / 4
			}
			// Set newcap to the requested cap when
			// the newcap calculation overflowed.
			if newcap <= 0 {
				newcap = cap
			}
		}
	}

	var overflow bool
	var lenmem, newlenmem, capmem uintptr
	// Specialize for common values of et.size.
	// For 1 we don't need any division/multiplication.
	// For sys.PtrSize, compiler will optimize division/multiplication into a shift by a constant.
	// For powers of 2, use a variable shift.
	switch {
	case et.size == 1:
		lenmem = uintptr(old.len)
		newlenmem = uintptr(cap)
		capmem = roundupsize(uintptr(newcap))
		overflow = uintptr(newcap) > maxAlloc
		newcap = int(capmem)
	case et.size == sys.PtrSize:
		lenmem = uintptr(old.len) * sys.PtrSize
		newlenmem = uintptr(cap) * sys.PtrSize
		capmem = roundupsize(uintptr(newcap) * sys.PtrSize)
		overflow = uintptr(newcap) > maxAlloc/sys.PtrSize
		newcap = int(capmem / sys.PtrSize)
	case isPowerOfTwo(et.size):
		var shift uintptr
		if sys.PtrSize == 8 {
			// Mask shift for better code generation.
			shift = uintptr(sys.Ctz64(uint64(et.size))) & 63
		} else {
			shift = uintptr(sys.Ctz32(uint32(et.size))) & 31
		}
		lenmem = uintptr(old.len) << shift
		newlenmem = uintptr(cap) << shift
		capmem = roundupsize(uintptr(newcap) << shift)
		overflow = uintptr(newcap) > (maxAlloc >> shift)
		newcap = int(capmem >> shift)
	default:
		lenmem = uintptr(old.len) * et.size
		newlenmem = uintptr(cap) * et.size
		capmem, overflow = math.MulUintptr(et.size, uintptr(newcap))
		capmem = roundupsize(capmem)
		newcap = int(capmem / et.size)
	}

	// The check of overflow in addition to capmem > maxAlloc is needed
	// to prevent an overflow which can be used to trigger a segfault
	// on 32bit architectures with this example program:
	//
	// type T [1<<27 + 1]int64
	//
	// var d T
	// var s []T
	//
	// func main() {
	//   s = append(s, d, d, d, d)
	//   print(len(s), "\n")
	// }
	if overflow || capmem > maxAlloc {
		panic(errorString("growslice: cap out of range"))
	}

	var p unsafe.Pointer
	if et.kind&kindNoPointers != 0 {
		p = mallocgc(capmem, nil, false)
		// The append() that calls growslice is going to overwrite from old.len to cap (which will be the new length).
		// Only clear the part that will not be overwritten.
		memclrNoHeapPointers(add(p, newlenmem), capmem-newlenmem)
	} else {
		// Note: can't use rawmem (which avoids zeroing of memory), because then GC can scan uninitialized memory.
		p = mallocgc(capmem, et, true)
		if writeBarrier.enabled {
			// Only shade the pointers in old.array since we know the destination slice p
			// only contains nil pointers because it has been cleared during alloc.
			bulkBarrierPreWriteSrcOnly(uintptr(p), uintptr(old.array), lenmem)
		}
	}
	memmove(p, old.array, lenmem)

	return slice{p, old.len, newcap}
}

```

总之扩容之后是否指向一个新地址是不确定的。 所以使用切片的时候需要注意扩容的时候，切片的地址可能发生变化   


## 闭包  

注意以例子在go1.12中不会输出, 如果需要输出的话，需要配合channel 
```
	old := []int{1, 2, 3, 4, 5}

	for index, _ := range old {
		in := index
		go func(i int) {
			fmt.Println("fmt print in cycle", i, in)
		}(index)
	}
```

##　解决循环依赖　　

快速编译　
合理规划代码结构　　
巧妙使用接口，便于mock


```
package root
type DBService interface {
    searchInfoByFullName(name string)
}
```

```
package user
type User Struct {
    dbsrv DBService
}
var usr User
usr.dbsrv = new(DbInstance)
user.dbsrv.searchInfoByFullName('jonson')
```

