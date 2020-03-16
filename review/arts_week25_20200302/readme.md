


https://www.youtube.com/watch?v=2xkwmyTlvHY  

A Snapshot of API Design Trends In 2019 

# 5中主流的api设计趋势 

## 1. 开发者体验 
 * 开始指导  
 * 可读性强的方法描述   
 * 样例请求和示例  
 * 测试环境  
 
* 立即加载
* 可搜索
* 有特色的主题
* 状态部件 
* 样例可复制 
* 黑夜模式
* 给页面打分  

### 比较好的例子  
* Stripe
* Github
* Shopify 
* twillo 

## 2. GraphQL 
### context 
* 应用查询语言
* facebook出品 
* 统一了请求和数据获取的流程 
## 好处
* 简化
* 高效： 将数据放到单个请求中 
* 稳定： 社区支持
* 兼容
* 易学 
## 例子
* AWS AppSync 
* AirBnb 
* twitter 
* Walmart 
## 工具链 
GraphiQL & graphdoc && Voyager 

##　3. OpenAPI 
### context 
在restful风格中，机器易读的接口--描述，生产，消费，可视化web服务
### Use Case
* 文档
* 自动生成lib & sdk 
* 设计优先
* 测试
* 速度快，安全，自动生成
### 社区 
2011--Smartbear Tony Tam 
* 2016 linux基金会，30多个成员  
### 示例代码  
均由yaml 编写 
### 工具链 
SwaggerUI & ReDoc & Swagger Codegen 

## 4. 异步api 
### context 
事件驱动架构 webhooks, rest hooks,pub-sub, websockets 
### 协议 
* AMQP
* MQTT
* WebSocket 
* Google Cloud Pub/Sib
* CoAP
* NATS 
* Kafka 
* HTTP
* JMS
* STOMP 
### 好处 
* 机器可读
* 人员可读 
* 消息中自定义header 
* 开源  
* 消息驱动 
### 工具链
Playground &　AsyncAPI Generator & Validator 

## 5. Oauth + OpenID Connect 



