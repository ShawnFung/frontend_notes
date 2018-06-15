## localStorage

### 参考文档
1. [localStorage 存满了怎么办？](https://juejin.im/entry/5b1d0529e51d45069352d1b2)
2. [详说 Cookie, LocalStorage 与 SessionStorage](http://jerryzou.com/posts/cookie-and-web-storage/)

### 先来看几道面试题吧
1. a.meituan.com 和 b.meituan.com 这两个域能够共享同一个 localStorage 吗？  
  答：不能，localStorage 只能在同一个域名共享，不能跨域访问。

2. 在 webview 中打开一个页面：i.meituan.com/home.html，点击一个按钮，调用 js 桥打开一个新的 webview：i.meituan.com/list.html，这两个分属不同 webview 的页面能共享同一个 localStorage 吗？能共享同一个 sessionStorage 吗？  
  答：能共享 localStorage。相当于同一个浏览器的不同标签页
    不能共享 sessionStorage。不同页面或标签页间无法共享 sessionStorage 的信息。这里需要注意的是，页面及标签页仅指顶级窗口，如果一个标签页包含多个 iframe 标签且他们属于同源页面，那么他们之间是可以共享 sessionStorage 的。

3. 如果 localStorage 存满了，再往里存东西，或者要存的东西超过了剩余容量，会发生什么？  
  答：存不进去并报错（QuotaExceededError）

### localStorage 跨域解决方案


### localStorage 与 sessionStorage、cookie 的区别？
| 特性 | localStorage | sessionStorage | cookie |
|---------|---------|---------|---------|
| 大小限制 | 一般为5MB | 一般为5MB | 4KB左右
| 数据的生命期 | 除非被清除，否则永久保存（持久化的本地存储） | 仅在当前会话下有效，关闭页面或浏览器后被清除（会话级别的存储） | 一般由服务器生成，可设置失效时间。如果在浏览器端生成Cookie，默认是关闭浏览器后失效
| 与服务器通信 | 不参与| 不参与 |  每次都会携带在HTTP头中