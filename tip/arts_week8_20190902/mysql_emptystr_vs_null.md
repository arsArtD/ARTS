
mysql 中 empty 与 null 的差别

null值查询使用is null/is not null查询，而empty string使用=或者!=查询即可

https://stackoverflow.com/questions/1106258/mysql-null-vs 


## note1  高性能mysql提及：
Avoid NULL if possible. A lot of tables include nullable columns even when the application does not need to 
store NULL (the absence of a value), merely because it’s the default. It’s usually best to specify columns 
as NOT NULL unless you intend to store NULL in them. It’s harder for MySQL to optimize queries that refer 
to nullable columns, because they make indexes, index statistics, and value comparisons more complicated. 
A nullable column uses more storage space and requires special processing inside MySQL. When a nullable 
column is indexed, it requires an extra byte per entry and can even cause a fixed-size index (such as 
an index on a single integer column) to be converted to a variable-sized one in MyISAM. The performance 
improvement from changing NULL columns to NOT NULL is usually small, so don’t make it a priority to find 
and change them on an existing schema unless you know they are causing problems. However, if you’re planning 
to index columns, avoid making them nullable if possible. There are exceptions, of course. For example, 
it’s worth mentioning that InnoDB stores NULL with a single bit, so it can be pretty space-efficient for 
sparsely populated data. This doesn’t apply to MyISAM, though.  


#  note2:  

For MyISAM tables, NULL creates an extra bit for each NULLABLE column (the null bit) for each row. If the 
column is not NULLABLE, the extra bit of information is never needed. However, that is padded out to 8 bit 
bytes so you always gain 1 + mod 8 bytes for the count of NULLABLE columns. 

Text columns are a little different from other datatypes. First, for "" the table entry holds the two byte 
length of the string followed by the bytes of the string and is a variant length structure. In the case of 
NULL, there's no need for the length information but it's included anyways as part of the column structure.

In InnoDB, NULLS take no space: They simply don't exist in the data set. The same is true for the empty string 
as the data offsets don't exist either. The only difference is that the NULLs will have the NULL bit set while 
the empty strings won't.  

When the data is actually laid out on disk, NULL and '' take up EXACTLY THE SAME SPACE in both data types. 
However, when the value is searched, checking for NULL is slightly faster then checking for '' as you don't have 
to consider the data length in your calculations: you only check the null bit.  

As a result of the NULL and '' space differences, NULL and '' have NO SIZE IMPACT unless the column is specified 
to be NULLable or not. If the column is NOT NULL, only in MyISAM tables will you see any peformance difference 
(and then, obviously, default NULL can't be used so it's a moot question).  

The real question then boils down to the application interpretation of "no value set here" columns. If the "" is 
a valid value meaning "the user entered nothing here" or somesuch, then default NULL is preferable as you want to 
distinguish between NULL and "" when a record is entered that has no data in it. 

Generally though, default is really only useful for refactoring a database, when new values need to come into effect 
on old data. In that case, again, the choice depends upon how the application data is interpreted. For some old data, 
NULL is perfectly appropriate and the best fit (the column didn't exist before so it has NULL value now!). For 
others, "" is more appropriate (often when the queries use SELECT * and NULL causes crash problems).  

In ULTRA-GENERAL TERMS (and from a philosophical standpoint) default NULL for NULLABLE columns is preferred as it 
gives the best semantic interpretation of "No Value Specified".


