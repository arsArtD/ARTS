

https://mp.weixin.qq.com/s/kJG6Kpf2AXqv_wNAp55EPw  


# 只使用 CSS 进行用户追踪 


## 找到设备类型信息

```
@media only screen and(max-width: 768px) {
  body {
    background-image: url("http://localhost:8080/mobile");
   }
} 
```

## 找到操作系统信息

```
@font-face {
    font-family: Font2;
    src: url("http://localhost:8080/notmac");
}

body {
    font-family: linkMacSystemFont, Font2, "Arial";
}
```

## 追踪元素信息

```
<head>
<style>
#one:hover {
      background-image: url("http://localhost:8080/one-hovered/");
}
</style>
</head>
<body>
<buttonid="one">Hover me</button>
</body>
```


## 犹豫计时器
```
let counter;
app.get("/one-hovered", (req, res) => {
  counter = Date.now();
});

app.get("/one-active", (req, res) => {
  console.log("Clicked after", (Date.now() - counter) / 1000, "seconds");
});
```


## 更美观的写法

```
@font-face {
  font-family: Font2;
  src: url("http://192.168.2.110:8080/os/mac");
  /* or: */
  src: url("http://192.168.2.110:8080/?os=mac");
}
```
