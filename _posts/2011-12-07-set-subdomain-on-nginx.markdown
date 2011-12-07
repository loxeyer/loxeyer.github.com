---
layout: post
title: 在nginx下设置二级域名 
tags: [osx, mac, lion]
-
** 概念 **

这两个概念很容易混淆，看个例子区分一下二者的定义：

test.belink.com和demo.belink.com是二级域名
belink.com/test和belink.com/demo是个性域名

** 二级域名的实现 **

'''思路'''：通过nginx的rewrite模块，把xxx.belink.com指向到belink.com/xxx，xxx是可变的，每次增加二级域名时修改hosts文件即可。在hosts中增加一行:

127.0.0.1 test.belink.com

要有对hosts的修改权限。

可参考https://wangyan.org/blog/nginx-subdomain.html

支持thinkphp重写的nginx的配置如下：

{% highlight console %}
server {
    listen 80; 
    server_name *.auth.com;

    if ( $host ~* (\b(?!www\b)\w+)\.\w+\.\w+ ) { 
        set $test $1; 
    }   

    root /data/web/rbac/app/$test;

    index index.php index.html index.htm;

    if (!-e $request_filename)
    {   
        rewrite ^/(.*)$ /index.php/$1 last;
        break;
    }   

    location ~ .*\.php(.*)$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_split_path_info ^(.+\.php)(.*)$;
        include fastcgi_params;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }   
}
{%endhighlight%}

两步实现个性域名

在php的各个框架中，基本上都是采用单入口模式，如当访问belink.com/user/login时，实际访问的是belink.com/index.php?controller=user&action=login，即所有访问都会通过index.php进行url分发。如果要实现个性域名belink.com/gaolin时，实际上会访问belink.com/index.php?controller=user&action=view&name=gaolin

1，把belink.com/index.php?controller=user&action=view&name=gaolin转化成belink.com/user/view/gaolin

这一步是通过框架内部的url和route模块实现的

2,把belink.com/user/view/gaolin转化成belink.com/gaolin

通过nginx是可以实现的，如果php端要个性/user/view中的某一路径时，必须把nginx配置文件相匹配，否则无法正确指向，这也导致个性域名不灵活。

因此可采用框架内部的路由机制来实现，要访问belink.com/gaolin时，首先会检测系统根目录是否有这样一个文件夹，并有索引文件，其次会检测是否有gaolin这样一个控制器，最后会用正则把gaolin匹配到/user/view/gaolin，实现:

{% highlight console %}
$route->set('profile', '<domain>', array('domain' => '[0-9a-zA-Z]+'))
 	->defaults(array(
 	    'controller' => 'user',
 	    'action' => 'view',
 	));
{% endhighlight %}
