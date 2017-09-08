# php各版本的姿势(不同版本的利用特性)

---

[PHP官方手册附录](http://php.net/manual/zh/appendices.php)

---

## php5.2以前

- 1. `__autoload`加载类文件，但只能调用一次这个函数，所以可以用`spl_autoload_register`加载类

## php5.3

1. 新增了`glob://`和`phar://`流包装
`glob`用来列目录，绕过`open_baedir`
[](http://php.net/manual/zh/wrappers.phar.php)
`phar`在文件包含中可以用来绕过一些后缀的限制
[](http://php.net/manual/zh/wrappers.phar.php

2. 新的全局变量`__DIR__`
3. 默认开启`<?= $xxoo;?>`，`5.4`也可用

## php5.4

1. 移除安全模式、魔术引号
2. `register_globals` 和 `register_long_arrays php.ini` 指令被移除。
3. `php.ini`新增`session.upload_progress.enabled`，默认为`1`，可用来文件包含
[](http://php.net/manual/zh/session.configuration.php)
[](http://php.net/manual/zh/session.upload-progress.php)

## php5.5

1. 废除`preg_replace`的`/e`模式(不是移除)
当使用被弃用的 `e` 修饰符时, 这个函数会转义一些字符(即：`'`、`"`、  和 `NULL`) 然后进行后向引用替换。
[](http://php.net/manual/zh/function.preg-replace.php)

## php5.6

1. 使用 `...` 运算符定义变长参数函数
[](http://php.net/manual/zh/functions.arguments.php#functions.variable-arg-list)

## php7.0

1. 十六进制字符串不再是认为是数字
2. 移除`asp`和`script php`标签
```
<% %>
<%= %>
<script language="php"></script>
```
3. 在后面的版本中`assert`变成语言结构，这将意味着很多一句话不能使用。
目前经过测试,可使用的有。
```
call_user_func('assert', 'phpinfo();'); 
```

## php7.1

1. 废除`mb_ereg_replace()`和`mb_eregi_replace()`的`Eval`选项
[](http://php.net/manual/zh/migration71.new-features.php)
