---
layout: post
title: 如何导出一个git项目 
tags: [osx, mac, lion]
---

如何像svn export一样导出一个项目呢？

没有git export命令，导出项目可用git archive命令，默认情况下，它是导出一个tar压缩包。

**看个例子**

进入到git项目的根目录，运行下面的命令，并在当前项目中创建latest.tgz压缩包
{% highlight %}
git archive master | gzip > latest.tgz
{% endhighlight %}
**git导出帮助**

查看git命令 git help

查看git archive命令用git help archive

运行上面命令会出现以下介绍（展现部分），还有一些更详细的examples
