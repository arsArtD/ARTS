
https://medium.com/better-programming/why-the-guardian-switched-from-mongodb-to-postgresql-861b6cf01e1f


该文讲述了英国卫报数据库的迁移历程 

最开始的数据库是本地云，本地云偶尔的一次故障（过热导致的failover），使得该公司将数据库放在了AWS上。  

但monggodb自身带的管理工具不是很好用，维护成本很高，即时本身已经是付费用户。并且公司向自己管理数据库，而不是使用
mogngo服务的提供者所提供的monggo服务  

自然的，卫报的技术者们把眼光放在了AWS的NOSQL---DynamoDB.但是该服务有一个他们特别需要的核心功能不支持--encryption at rest  

最后卫报看中了postgre, 其中的数据类型jsonb恰好满足他们的需求，且在适配postgre的时候，碰到的问题在stackoverflow和
开源社区中都能找到答案 

当然他们在把服务迁移到postgre上时候也还有10个月的时间。期间他们进行了详细的测试，最后达到了只要切换一个按钮即可达到新旧环境的
升级（230w的文章数据迁移） 

如果这个选择放到现在，DynamoDB 已经支持了encryption at rest 。但是回迁到DynamoDB 也并非是一个非常好的选择
毕竟postgre除了支持NOSQL的特性，如果他们在日后的业务中如果有结构话的需求也能满足,这也能算做一个比较好运的技术决策吧  
