---
layout: post
title: git打包及界面工具 
tags: [tech]
---


###GIT UI 工具命令：

{% highlight console%}

git citool
git gui
gitk

{% endhighlight %}


###GIT format-patch

1 创建分支 git branch test

2 修改代码

3 在test分支上提交修改 git add and commit

4 git format-patch master test -1 可生成两个分支的不同

5 在master分支上直接 git apply 应用　

### reset回滚

git log -3

进行查看回滚版本号

git reset --hard xxx(版本号)

git reset --hard d35bea4344982d75623acc8205fdfff2e12469ee
