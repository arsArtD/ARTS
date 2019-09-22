

# git stash clear误删文件的恢复方法  

参照： https://www.jianshu.com/p/ae1987efec61?tdsourcetag=s_pcqq_aiomsg  

# git commit 修改方法  

git commit --amend  
(
git rebase -i HEAD~2 
git commit --amend  
git rebase --continue   
)
git push --force origin master(谨慎使用)
