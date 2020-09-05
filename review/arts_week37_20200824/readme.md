

阅读以下文章总结：  

https://mp.weixin.qq.com/s/xvzhtMdmgN7bpHz_eHb-7g


# 引文
raft协议分区容忍的一致性协议的核心思想：  
一致性的保证不一定非要所有节点都保持一致，只要大多数节点更新了，对于整个分布式系统来说数据也是一致性的。  
* raft协议概念：  
    * Leader election
    * Log replication
    * Safety
* raft模块化设计：  
    * Leader 选举
    * MemberShip 变更
    * 日志复制
    * Snapshot   
* raft设计原则：  
    * 日志不允许出现空洞, 并且 Raft限制了日志不一致的可能性  
    * 使用随机化时钟简化了领导选举的算法


# 领袖选举

raft保证leader健壮性的技术实现：  
*  超时驱动：Heartbeat/Election timeout  
*  随机的超时时间：降低选举碰撞导致选票被瓜分的概率  

投票规则： 
* 在任一任期内，单个节点最多只能投一票  
* 候选人知道的信息不能比自己的少优先：投票节点通过对比Term(任期)和CommitId来判断是否投“同意”票。  
* first-come-first-served 先来先得：收到多个RequestVote RPC拉票，对首先到达的进行投票  

选举流程：  
* Candidate发起投票时将自身当前任期加1(NewTerm)，并向集群中所有节点发起投票请求(RequestVote RPC：请求中包含新的任期值)；  
* follower节点 根据投票原则进行 投票
* Candidate得到大于半数节点的“同意”后成为Leader，与其他节点建立心跳，并更新所有节点的当前任期为NewTerm;  
* 如果不够半数，则选举失败，启用随机选举超时策略  
    * 所有 Condidate 随机sleep (即timeout)一段时间，然后开始新一轮的选举。  
    * 第一个苏醒 Condidate 会向所有 Condidate 发出投票给我的申请  
    * 还没有苏醒的 Condidate 就只能投票给已经苏醒的 Condidate 。  
    
# 日志复制 

日志格式：  
```
(TermId, LogIndex, LogValue)
其中 (TermId, LogIndex) 能确定唯一一条日志
```

复制策略原则：  
* 连续性  
* 有效性  
    * 一个log被复制到大多数节点，就是committed，保证不会回滚
    * leader一定包含最新的committed log，因此leader只会追加日志，不会删除覆盖日志
    * leader只能提交当前term的日志；不能提交前任日志
    * 当出现了leader与follower不一致的情况，leader强制follower复制自己的log  
    
Followers 日志有效性检查： 
* AppendEntries RPC中还会携带前一条日志的唯一标识(prevTermId, prevLogIndex)
* 递归推导  

Followers 日志恢复：
*  Leader 将 nextIndex 递减并重发 AppendEntries，直到与 leader 日志一致  

Raft协议的日志复制完整流程如下：
* leader 将client的请求命令作为一条新的日志项写入日志。
* leader 发送AppendEntries RPC 给follower 备份 该日志项。
* follower收到leader的AppendEntries RPC，将该日志项记录到日志并反馈ack。
* leader 收到 半数以上的follower 的ack，即认为消息发送成功
* leader 将 该日志项 提交状态机(state machine)处理
* leader 将执行结果返回给 client
* leader 发送AppendEntries RPC 通知 follower 提交状态机
* follower 收到AppendEntries RPC，follower判断该日志项是否已执行，若未执行则执行commitIndex以及之前的日志项。


# 安全性  
Radt协议通过一系列的规范定义，保证了整个Raft机制的数据的顺序一致性。整体原则如下：  
* 选举限制
    * 用投票规则的限制来组织日志不全的服务器赢得选举
        * RequestVote RPC限制规则: 拒绝日志没自己新的candidate
    * 领袖节点只能追加日志，不能重写或者删除日志
    * 日志条目只能从leader流向follower
* 如何提交上一个任期的日志条目
    * 全程保持自己的任期号
* 安全性论证
    * 领导人完整性原则(Leader Completeness)
        * 某指令在某个任期中存储成功，则保证存在于领袖该任期之后的记录中。
        * 不同节点，某位置上日志相同，那么该位置之前的所有日志一定是相同的。
    * 状态机安全原则(State Machine Safety)
        * 如果节点将某一位置的日志应用到了状态机，那么其他节点在同一位置不能应用不同的日志


通过上述的规范定义，我们可以通过一些异常场景来突出Raft协议的安全性：  

追随者死机：  
当某台追随者死机时，所有给它的转发指令和拉票的消息都会因没有回应而失败，此时发送端会持续重送。当这台追随者引导重新加入集群，就会收到这些消息，  
追随者会重新回应，如果转发的指令已经写入，不会重复写入。  

领袖死机  
领袖死机或断线时，每个已存储指令必定已经写入到过半的服务器中，此时选举流程会让记录最完整的服务器胜选。其中一个因素是Raft候选人拉票时会揭露  
自己记录最新一笔的信息，如果服务器自己的记录比较新，就不会投票给候选人。  

超时期限和可用性  
因为Raft引导选举是基于超时，使得超时期限的选择至为关键。若遵守算法的时限需求：广播时间 << 超时期限 << 平均故障间隔。这三个时间定义如下：  
* 广播时间：单一服务器发送消息给集群中每台服务器并得到回应的平均时间，需要测量得到。
* 超时期限：发动选举的超时期限，由部署Raft集群的人选定。
* 平均故障间隔：服务器发生故障之间的平均时间，可以测量或估计得到。
* 广播时间典型是 0.5ms 到 20ms，平均故障间隔通常是用周或月来计算的，所以可以将超时期限设在 10ms 到 500ms。  

# 总结  

选举限制
用投票规则的限制来组织日志不全的服务器赢得选举
RequestVote RPC限制规则: 拒绝日志没自己新的candidate
领袖节点只能追加日志，不能重写或者删除日志
日志条目只能从leader流向follower
如何提交上一个任期的日志条目
全程保持自己的任期号
安全性论证
领导人完整性原则(Leader Completeness)
某指令在某个任期中存储成功，则保证存在于领袖该任期之后的记录中。
不同节点，某位置上日志相同，那么该位置之前的所有日志一定是相同的。
状态机安全原则(State Machine Safety)
如果节点将某一位置的日志应用到了状态机，那么其他节点在同一位置不能应用不同的日志
通过上述的规范定义，我们可以通过一些异常场景来突出Raft协议的安全性：

追随者死机：  
当某台追随者死机时，所有给它的转发指令和拉票的消息都会因没有回应而失败，此时发送端会持续重送。当这台追随者引导重新加入集群，就会收到这些消息，追随者会重新回应，如果转发的指令已经写入，不会重复写入。

领袖死机  
领袖死机或断线时，每个已存储指令必定已经写入到过半的服务器中，此时选举流程会让记录最完整的服务器胜选。其中一个因素是Raft候选人拉票时会揭露自己记录最新一笔的信息，如果服务器自己的记录比较新，就不会投票给候选人。

超时期限和可用性  
因为Raft引导选举是基于超时，使得超时期限的选择至为关键。若遵守算法的时限需求：广播时间 << 超时期限 << 平均故障间隔。这三个时间定义如下：

广播时间：单一服务器发送消息给集群中每台服务器并得到回应的平均时间，需要测量得到。  
超时期限：发动选举的超时期限，由部署Raft集群的人选定。   
平均故障间隔：服务器发生故障之间的平均时间，可以测量或估计得到。  
广播时间典型是 0.5ms 到 20ms，平均故障间隔通常是用周或月来计算的，所以可以将超时期限设在 10ms 到 500ms。  


# 总结 
本文总体介绍了Raft协议的三个核心概念及对应流程规范，通过这三个概念流程我们可以很容易理解和实现Raft协议。Raft以容易理解著称，    
业界也涌现出很多 raft 实现，比如大名鼎鼎的 etcd, braft, tikv 等。也有很多知名的独立的Raft协议开源框架：    

https://github.com/sofastack/sofa-jraft/ 源于蚂蚁,java编写  
https://github.com/hashicorp/raft 源于hashicorp,go编写  
https://github.com/baidu/braft 源于百度,C++编写  
https://github.com/rabbitmq/ra 源于rabbitmq,Erlang编写  

