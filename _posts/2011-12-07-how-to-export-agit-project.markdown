---
layout: post
title: 如何导出一个git项目 
tags: [osx, mac, lion]

如何像svn export一样导出一个项目呢？

没有git export命令，导出项目可用git archive命令，默认情况下，它是导出一个tar压缩包。

**看个例子**

进入到git项目的根目录，运行下面的命令，并在当前项目中创建latest.tgz压缩包

git archive master | gzip > latest.tgz

**git导出帮助**

查看git命令 git help

查看git archive命令用git help archive

运行上面命令会出现以下介绍（展现部分），还有一些更详细的examples

{% hightlight %}
NAME
       git-archive - Create an archive of files from a named tree

SYNOPSIS
       git archive [--format=<fmt>] [--list] [--prefix=<prefix>/] [<extra>]
                     [-o | --output=<file>] [--worktree-attributes]
                     [--remote=<repo> [--exec=<git-upload-archive>]] <tree-ish>
                     [<path>...]

DESCRIPTION
       Creates an archive of the specified format containing the tree structure for the named tree, and writes it out to the standard output. If
       <prefix> is specified it is prepended to the filenames in the archive.

       git archive behaves differently when given a tree ID versus when given a commit ID or tag ID. In the first case the current time is used as
       the modification time of each file in the archive. In the latter case the commit time as recorded in the referenced commit object is used
       instead. Additionally the commit ID is stored in a global extended pax header if the tar format is used; it can be extracted using git
       get-tar-commit-id. In ZIP files it is stored as a file comment.
{% endhightlight %}
