
阅读下述文章总结:  
https://mp.weixin.qq.com/s/o7Ac5VGe5tp02Co1ok7ylw  

# 一致性算法-Gossip协议详解二(Memberlist实践)

比较常见的Gossip 协议实现框架有：  

java：https://github.com/scalecube/scalecube-cluster scalecube(伸缩立方)社区  
go：https://github.com/hashicorp/memberlist  hashicorp公司出品  

memberlist 是HashiCorp公司出品的go语言开发库，使用基于Gossip协议管理集群成员和成员失败检测。咱们本文的主题就是memberlist。  
严格说起来，memberlist是基于Gossip协议变种实现的，它的指导论文是康奈尔大学计算机科学系Abhinandan Das, Indranil Gupta, Ashish Motivala  
在2002年发表的《SWIM:Scalable Weakly-consistent/Infection-styleProcess Group Membership Protocol》。  

Membership协议中文名是 可伸缩最终一致性感染成员组协议。原理通过一个有效的点对点随机探测机制进行监控协议成员的故障检测、更新传播。  
Memberlist 构建在SWIM Membership之上，跟原始gossip协议有了一些补充和调整。咱们接下去从项目介绍、节点状态、消息类型、数据通讯来解说下。  



## 项目介绍
* 项目在memberlist.go 函数Create启动，调用sate.go中函数schedule
* Schedule函数开启probe协程、pushpull协程、gossip协程
* probe协程：进行节点状态维护
* push/pull协程：进行节点状态、用户数据同步
* gossip协程：进行udp广播发送消息。


## 节点状态
memberlist利用点对点随机探测机制实现成员的故障检测，因此将节点的状态分为3种：  
StateAlive：活动节点  
StateSuspect：可疑节点  
StateDead：死亡节点  

probe协程通过点对点随机探测实现成员的故障检测，强化系统的高可用。整体流程如下：  

* 随机探测：节点启动后，每隔一定时间间隔，会选取一个节点对其发送PING消息。
* 重试与间隔探测请求：PING消息失败后，会随机选取N（由config中IndirectChecks设置）个节点发起间接PING请求和再发起一个TCP PING消息。
* 间隔探测：收到间接PING请求的节点会根据请求中的地址发起一个PING消息，将PING的结果返回给间接请求的源节点。
* 探测超时标识可疑：如果探测超时之间内，本节点没有收到任何一个要探测节点的ACK消息，则标记要探测的节点状态为suspect。
* 可疑节点广播：启动一个定时器用于发出一个suspect广播，此期间内如果收到其他节点发来的相同的suspect信息时，将本地suspect的 确认数+1，当定时器超时后，
该节点信息仍然不是alive的，且确认数达到要求，会将该节点标记为dead。
* 可疑消除：当本节点收到别的节点发来的suspect消息时，会发送alive广播，从而清除其他节点上的suspect标记。。
* 死亡通知:当本节点离开集群时或者本地探测的其他节点超时被标记死亡，会向集群发送本节点dead广播
* 死亡消除:如果从其他节点收到自身的dead广播消息时，说明本节点相对于其他节点网络分区，此时会发起一个alive广播以修正其他节点上存储的本节点数据。


## 消息类型
Memberlist在整个生命周期内，总的有两种类型的消息：  
* udp协议消息：传输PING消息、间接PING消息、ACK消息、NACK消息、Suspect消息、 Alive消息、Dead消息、消息广播；
* tcp协议消息：用户数据同步、节点状态同步、PUSH-PULL消息。

## 数据通讯
push/pull协程周期性的从已知的alive的集群节点中选1个节点进行push/pull交换信息。交换的信息包含2种  
* 集群信息：节点数据  
* 用户自定义的信息：实现Delegate接口的struct。

push/pull协程可以加速集群内信息的收敛速度，整体流程为： 
* 建立TCP链接：每隔一个时间间隔，随机选取一个节点，跟它建立tcp连接，
* 将本地的全部节点 状态、用户数据发送过去，
* 对端将其掌握的全部节点状态、用户数据发送回来，然后完成2份数据的合并。

Gossip协程通过udp协议向K个节点发送消息，节点从广播队列里面获取消息，广播队列里的消息发送失败超过一定次数后，消息就会被丢弃  
