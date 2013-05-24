---
layout: post
title: 0.0块的介绍 
tags: [tech]
---

###熟悉一下块

块通常是初级ruby开发者遇到的第一个易混淆的难点。什么是块？块为什么要存在？我们该如何使用块呢？

我会在这一课尽我所能回答所有这些问题

###什么是块？

块不是Ruby独有的。块的官方的定义是“组合在一起的一段的代码。”当然，我猜这不会帮助你太多。

一个简单的方法来描述块是“块是可以像任何其他对象存储在变量里的一段代码，并且根据需求来运行这些变量。”让我来帮你建立一个心理模型的代码来展示块，然后用Ruby块重构它。我们可以开始编写一些代码，做一些有意义的小事，比如两个数字相加？

{% highlight console%}
puts 5 + 6
{% endhighlight %}

很棒。运行成功！然而，这只涵盖了第一个定义 - 它是一段代码。它并没有“组合在一起”, 而且，也不是存储在一个变量里。让我们需要做更多来符合上面的定义之前先看看组合吧。

{% highlight console%}
a = 5
b = 6
puts a + b
{% endhighlight %}

又运行成功了。我们已经用变量替换了数字。但是，做加法的代码仍然没有存储在变量中。让我们做到这一点！

{% highlight console%}
addition = lambda {|a, b| return a + b }
puts addition.call(5, 6)
{% endhighlight %}

现在你有了分组 - 完整的块！在Ruby中用来创建一个块,'lambda'关键字是最常用的。还有其他的方式做到这一点，但还是让事情简单一点吧。

这时，如果你正在想“等一下，这看起来非常像一个方法，并且没有类或对象”，那么你是绝对正确的。试着想像一下它是这样的：块像一个方法，但与任何对象没有半毛关系。让我们认真认识一下块。块是对象吗？是的，他们像Ruby中的几乎一切都是对象一样也是对象。

{% highlight console%}
empty_block = lambda { }
puts empty_block.object_id
puts empty_block.class
puts empty_block.class.superclass
{% endhighlight %}

正如你可以看到，我们刚刚创建的块的object_id，属于类PROC（在Ruby里这被称为是一个块），PROC是Object的一个子类。

我们依据块跳过定义直接实现方法。一个方法是一个很容易绑定到对象的块，且可以访问对象的状态。

让我举例说明通过Ruby方法如何逆向产生一个块。这里有一个与前面的问题相比更传统的方法（请原谅我糟糕的对象建模）：

{% highlight console%}
class Calculator
  def add(a, b)
    return a + b
  end
end
puts Calculator.new.add(5, 6)
{% endhighlight %}

运行结果如你期望的一样，现在让我们做的多一点。

{% highlight console%}
class Calculator
  def add(a, b)
    return a + b
  end
end

addition_method = Calculator.new.method("add")
addition =  addition_method.to_proc

puts addition.call(5, 6)
{% endhighlight %}

在这里你有了它 - 一个普通的老式方法转换到一个更酷的块！你要注意了！在下一节中，我们将扩展这个问题的范围，来让你变的更牛逼。

###写你的块！

让我们建立4个块,加减乘除。每块都应该接受两个值，执行该操作，并返回结果。我们已经为你做了更多，快点爽爽的写一下余下的例子吧。

{% highlight console%}
Addition = lambda {|a, b| return a + b } # use this as your example!

Subtraction = lambda { } # your code between the braces

Multiplication = lambda { } # your code between the braces

Division = lambda { } # your code between the braces

{% endhighlight %}


参考:
<http://rubymonk.com/learning/books/4-ruby-primer-ascent/chapters/18-blocks/lessons/51-new-lesson>
