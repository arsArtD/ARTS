

https://mp.weixin.qq.com/s/vVTamH82ntbSBHxTbEw_LQ
 


大批量删除数据时最好使用循环+limit  


delete from t where sex = 1;   

1. 降低写错 SQL 的代价，就算删错了，比如 limit 500, 那也就丢了 500 条数据，并不致命，通过 binlog 也可以很快恢复数据。  
2. 避免了长事务，delete 执行时 MySQL 会将所有涉及的行加写锁和 Gap 锁（间隙锁），所有 DML 语句执行相关行会被锁住，如果删除数量大，会直接影响相关业务无法使用。  
3. delete 数据量大时，不加 limit 容易把 cpu 打满，导致越删越慢。    
针对上述第二点，前提是 sex 上加了索引，大家都知道，加锁都是基于索引的，如果 sex 字段没索引，就会扫描到主键索引上，那么就算 sex = 1 的只有一条记录，也会锁表。  
