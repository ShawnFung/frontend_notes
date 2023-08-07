# Ajax

## 搭建 mock 服务器
### [Mock.js](http://mockjs.com/)
Mock.js 的强大之处：
- 前端劫持 Ajax，只能劫持 XHR，不能劫持 Fetch
- 全面的 Random 能力

Mockjs 实现的原理是对 XHR 对象的拦截，属于 js 拦截，并没有通过浏览器发出请求，所以一般会碰到以下问题。
- 虽然是无侵入式，如果要打包上线，需要把 mockjs 删除
- 无法在浏览器调试工具里查看请求链接和请求参数
- 无法调试反向代理，处理跨域问题

### node.js服务 + Mock.js



### 在线 Mock 平台
不稳定，可能不维护了。有数据泄漏风险（多人使用，难免会写敏感数据）
- fast-mock
- y-api
- swagger - 尽量不推荐用国外平台（可以用做工具，但别用作服务）

## 参考文档
- [Mock.js 超全 超详细总结 保姆级别的教程](https://blog.csdn.net/Mme061300/article/details/130343270)
