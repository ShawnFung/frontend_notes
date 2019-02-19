# Cookies
Cookies 遵守同源策略

## Cookies特性
- 域名，只能使用自己域名下的 Cookie。
- 有效期，一旦超过有效期，Cookie就会失效。
```js
document.cookie = "a=1; expires=Tue, 19 Feb 2019 15:22:36 GMT";
// 注意这个有效时间是格林乔治时间，可以通过 date.toGMTString(); 获取。
```
- 路径
- http-only，只能在请求中使用 Cookie，在 js 中不能使用 Cookie。
- secure，只能在 https 协议下，才能使用
- samesite，第三方网站能否使用 Cookie