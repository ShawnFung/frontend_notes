## Postman

### 主要功能
* 主要用于模拟网络请求包
* 快速创建请求(GET, POST等)
* 回放、管理请求
* 快速设置网络代理

### 如何使用
安装 Postman 和 Postman Interceptor。[插件地址](http://chromecj.com/list/)

### Questions
1. 如何模拟登录调试？  
方案一：使用 Postman Interceptor  ，可以帮助用户通过Postman应用程序发送带有浏览器Cookie的请求。  
注意事项：  
* Postman Interceptor 必须和 Postman 联合使用。
* Postmanintercept 的版本要与 postman 的版本匹配，否则 send 请求，会一直是 loading 的状态。


参考文档：
1. [postman模拟登录调试](http://www.afox.cc/archives/427)
2. [Postman用法简介](http://blog.csdn.net/flowerspring/article/details/52774399)
3. [Postman Interceptor 介绍](http://chromecj.com/web-development/2017-08/785.html)