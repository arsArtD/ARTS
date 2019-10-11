

# git log 更好的格式显示
git log --oneline --no-merges --decorate --pretty=format:"%cn committed %h on %cd" |  grep -v 'zhao' | grep -v 'zz' | awk '{print $3}'   

# git merge的时候不提交
git merge --no-commit

# git reset
git reset HEAD^ --soft (Save your changes, back to last commit)  
git reset HEAD^ --hard (Discard changes, back to last commit)  

