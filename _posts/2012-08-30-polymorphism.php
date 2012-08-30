---
layout: post
title: Object C 和 PHP多态对比
tags: [tech]
---

### 什么是多态(polymorphism)

polymorphism = poly(多的)+morphism(形态，即form的变体)

多态即通过一个接口进去，出来的数据或者表现形式是不同的。

比如pk360是战争之王的一个接口，而qq,xiaomi,baidu是他的SB对手，打架的结局也是不一样的，结局概括为输,羸,两败俱伤和全是胜者

####1,PHP多态实例 

{% highlight console%}
<?php 

class SB{//定义360的打架对手父类

	protected function vs360(){//定义他们要做的行为，不是联盟，而针尖对麦芒，需要在子类的实现
		echo "本方法需要在子类中重载!";
	}
}

class QQ extends SB{//定义qq类

	public function vs360(){//实现和360pk方法
		echo "被五毛首领镇压，结果两败俱伤，五毛和天朝二代们笑了！\n";
	}
}

class Xiaomi extends SB{//定义xiaomi类

	public function vs360(){
		echo "小米被打的落花流水，两年内颗粒无收！\n";
	}
}

class Baidu extends SB{//定义baidu类

	public function vs360(){
		echo "战争之王遇到了美女度娘，被美人计重伤！";
	}
}

function pk360($obj){//定义观众看狗咬狗pk方法

	if($obj instanceof SB){//判断是否360的对手对象
		$obj->vs360();
	}else{//否则显示错误信息
		echo "你还没有资格和360单挑!";
	}
}

pk360(new QQ());
pk360(new Xiaomi());
pk360(new Baidu());

?>
{% endhighlight %}

#### 2、Object 多态实例

####SB.h

{% highlight console%}
#import <Foundation/Foundation.h>
@interface SB : NSObject

- (void) vs360;

@end
{% endhighlight %}

####SB.m

{% highlight console%}
#import "SB.h"
@implementation SB

- (void) vs360 {}

@end
{% endhighlight %}

####QQ.h

{% highlight console%}
#import "SB.h"

@interface QQ : SB

@end
{% endhighlight %}

####QQ.m

{% highlight console%}
#import "QQ.h"

@implementation QQ
- (void) vs360 {
	    NSLog(@"被五毛首领镇压，结果两败俱伤，五毛和天朝二代们笑了!");
}
@end
{% endhighlight %}

####Xiaomi.h

{% highlight console%}
#import "SB.h"

@interface Xiaomi : SB

@end
{% endhighlight %}

####Xiaomi.m

{% highlight console%}
#import "Xiaomi.h"

@implementation Xiaomi
- (void) vs360 {
	    NSLog(@"小米被打的落花流水，两年内颗粒无收!");
}
@end
{% endhighlight %}

####Baidu.h

{% highlight console%}
#import "SB.h"

@interface Baidu : SB

@end
{% endhighlight %}

####Baidu.m

{% highlight console%}
#import "Baidu.h"

@implementation Baidu
- (void) vs360 {
	    NSLog(@"战争之王遇到了美女度娘，被美人计重伤!");
}
@end
{% endhighlight %}

####main.m

{% highlight console%}

#import "QQ.h"
#import "Xiaomi.h"
#import "Baidu.h"

int main(int argc, char *argv[])
{
    SB *sb;
    sb = [[QQ alloc] init];
    [sb vs360];
    [sb release];
					    
    sb = [[Xiaomi alloc] init];
    [sb vs360];
    [sb release];
						    
    sb = [[Baidu alloc] init];
    [sb vs360];
    [sb release];
											    
    return 0;
}
{% endhighlight %}
