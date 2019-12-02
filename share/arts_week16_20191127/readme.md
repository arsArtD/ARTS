

通过ssh通道从远程数据库下载数据到本地数据库的脚本

```
#!/bin/bash

# table.txt 是需要从远程数据库下载的数据表的列表，每一行一个表名称
# 需要先在本地安装sshpass, yum install sshpass(Fedora/CentOS), apt-get install sshpass(Ubuntu/Debian)
# 需要改进的地方： 如果db的 net_read_timeout设置的时间较短，但是数据表又比较大的时候（20w条记录可能就会200M），容易出现超时断开的情况（mysqldump err 1023）
#      这种情况下，要么修改数据库参数（大多数情况可能没有权限改），要么记录上次下载到的地址，分批下载
#      在分批下载的情况下，一般会用到--skip-extended-insert参数，即一条记录就记录一条insert 语句（mysqldump默认是将一张表的数据记录到一个insert语句中，很容易触发mysql max_allowed_packet参数的限制）
#      具体实现可以参照navicat在导出表的时候的操作
# mysqldump导出数据到本地的时候需要忽略gtid同步，--set-gtid-purged=OFF
# mysqldump导出的时候会锁表，为了避免权限问题（msyqldump err 1044），可以添加：--single-transaction  
# 导入的时候，如果表没有默认值，会触发（Data truncated for column）错误。修正方法：修改表字段的取值范围 或者 修改错误数据中的字段(这个需要看情况)

test_db_host={your db host: ip or host}
test_db_user={remote db username}
test_db_passwd={remote db passwd, special chars need use '\' transfer}
test_db_name={remote db dbname}
test_db_tables=$(cat table.txt)

local_host={本地ip}
local_user={本地db user}
local_passwd={本地db passwd, special chars need use '\' transfer}
local_db={本地db dbname}

ssh_host={跳板机ip or host}
ssh_user={跳板机username}
ssh_psw={跳板机userpassword, special chars need use '\' transfer}

for table in $test_db_tables;do
  echo "export $table start at `date`"
  sshpass -p $ssh_psw ssh -o StrictHostKeyChecking=no $ssh_user@$ssh_host "mysqldump --single-transaction --set-gtid-purged=OFF  -h $test_db_host -u$test_db_user --password='$test_db_passwd' $test_db_name $table" > $table.sql
  echo "export $table end at `date`"
  echo -e '\n\n'
done

for table in $test_db_tables;do
  echo "import $table start at `date`"
  mysql -h$local_host -u$local_user --password='$local_passwd' -e "use $local_db;source $table.sql;"
  echo "import $table start at `date`"
  echo "\n\n"
done

```
