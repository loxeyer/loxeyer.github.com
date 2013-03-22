---
layout: post
title: 安装rvm,ruby,rails,passenger,nginx在centos 
tags: [tech]
---


###版本
centos 6.4
ruby 2.0.0
rails 3.2.12

###第一步：安装rvm

{% highlight console%}
sudo yum update
sudo yum install curl
curl -L get.rvm.io | bash -s stable
source /etc/profile.d/rvm.sh

rvm requirements
yum install gcc-c++ patch readline readline-devel zlib zlib-devel libyaml-devel libffi-devel openssl-devel make bzip2 autoconf automake libtool bison iconv-devel
{% endhighlight %}


###第二步：安装ruby

{% highlight console%}
rvm list known 
rvm install 2.0.0

ruby -v
gem list
gem sources -l
gem sources --remove 要删除的源
gem sources -a http://ruby.taobao.org/
{% endhighlight %}

###第三步：安装rails

{% highlight console%}
gem install rails
rails -v
{% endhighlight %}

###第四步：安装passenger

{% highlight console%}
gem install passenger
passenger -v
{% endhighlight %}
找到passenger的bin目录

{% highlight console%}
./passenger-2.2.14/bin/passenger-install-nginx-module
{% endhighlight %}

###第五步：安装nginx

nginx安装需要pcre and openssl

官网：http://www.pcre.org/

{% highlight console%}
wget ftp://ftp.csx.cam.ac.uk/pub/software/programming/pcre/pcre-8.32.tar.gz
tar zxvf pcre-8.32.tar.gz
cd pcre-8.32
./configure
make
make install
{% endhighlight %}

官网：http://www.openssl.org

{% highlight console%}
wget http://www.openssl.org/source/openssl-1.0.1e.tar.gz
tar zxvf openssl-1.0.1e.tar.gz
cd openssl-1.0.1e
./config
make
make install
{% endhighlight %}

{% highlight console%}
wget http://nginx.org/download/nginx-1.3.14.tar.gz
tar zxvf nginx-1.3.14.tar.gz
./configure --prefix=/usr/local/nginx
make
make install
 /user/local/nginx/sbin/nginx 
{% endhighlight %}

###第六步：安装mysql

系统自带mysql
yum install mysql-devel
gem install mysql2

参考:
<http://www.cnblogs.com/edwardlost/archive/2012/12/10/2811616.html>
<http://www.wiseg.net/?p=207>
<http://hideto.iteye.com/blog/853913>
