---
layout: post
title: Object C 几个知识点
tags: [tech]
---

## 判断是否是某个类的实例 isMemberOfClass

{% highlight console%}
main{
	Teacher *teacher = [[Teacher alloc] init];

	if ([teacher isMemberOfClass:[Teacher class]]) {
			NSLog(@"teacher Teacher类的实例");
	}
}
{% endhighlight %}

## 判断是否是某个类或者子类的实例 isKindOfClass

{% highlight console%}
main{
	Teacher *teacher = [[Teacher alloc] init];

	if ([teacher isMemberOfClass:[Person class]]) {
			NSLog(@"teacher Teacher类的实例");
	}
}
{% endhighlight %}

## respondsToSelector: 判读实例是否有这样方法

## instancesRespondToSelector:  判断类是否有这个方法。此方法是类方法，不能用在类的对象
