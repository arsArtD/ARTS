#                 存在     不存在
#insert ignore    忽略     插入
#insert into       报错      插入
#replace into     替换      插入

表要求：插入的数据中存在,PrimaryKey，或者unique索引的字段;   
结果：表id都会自增  
* replace into 替换插入的原理是:如果存在,先删除数据,再插入一条新的记录到表中,自增主键的值会增加  
* INSERT IGNOR  忽略插入的原理是:如果存在,原先对应的主键或者唯一键,不管其他字段的值有无变化,之前对应的这条数据都不会变化 
