

git push -u 在本地对应的远程分支是基于其他分支checkout的时候要额外注意

git checkout -b yourbranchname origin/oldbranchname

如果执行
git push -u origin yourbranchname

那么以后的提交包括pull都是基于 yourbranchname， 如果oldbranchname有更改，并不能pull下来

如果不慎执行了 git push -u 

可以通过 git branch --set-upstream-to=origin/oldbranchname 重新建立关联关系

