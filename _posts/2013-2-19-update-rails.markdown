---
layout: post
title: 切换rails版本
tags: [tech]
---

###准备工作

查看当前ruby和rails版本

{% highlight console%}
$ ruby -v
$ rails -v
{% endhighlight %}

ruby-1.9.3-p374
Rails 3.2.11

###升级rvm

把rvm升级到rvm 1.18.8 

{% highlight console%}
$ rvm get latest
$ rvm reload
$ rvm -v
{% endhighlight %}

###升级ruby

{% highlight console%}
$ rvm install ruby-1.9.3-p385
$ rvm --default use ruby-1.9.3-p385
$ ruby -v
{% endhighlight %}

此时系统有两个ruby版本

###用gemset切换rails

默认情况下，gemset用的是global,此时global对应的ruby版本是ruby-1.9.3.p385,rails版本是3.2.11

{% highlight console%}
$ rvm gemset create rails-3.2.12
$ rvm --default use ruby-1.9.3-p385@rails-3.2.12
$ gem install rails -v ">=3.2.12"
$ rvm --default use ruby-1.9.3-p385@global
{% endhighlight %}

此时rails版本升到3.2.12成功！！！

查看可选的ruby and rails版本

{% highlight console%}
$ rvm list known
$ rvm gemset list
$ gem list
{% endhighlight %}

如果配合passenger时可能会出现sha1报错，重新安装ruby前先安装下面两个组件
{% highlight console%}
$ rvm pkg install iconv
$ rvm pkg install openssl
{% endhighlight %}


如果系统自带ruby1.8.7，直接暴力删除即可。

{% highlight console%}
$ which ruby
{% endhighlight %}

安装ri手册
{% highlight console%}
gem install rdoc-data
rdoc-data --install  
{% endhighlight %}

安装时报warning: Insecure world writable dir /xxx, mode 041777错， 
运行下面命令可解决

{% highlight console%}
$ source /etc/profile 
$ rvm get latest
$ gem install rails -v ">=3.2.12"
{% endhighlight %}

参考:
<http://railsapps.github.com/installing-rails.html>
