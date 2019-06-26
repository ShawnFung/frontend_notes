# Cookies
Cookies 遵守同源策略

## Cookies特性
- 域名，只能使用自己域名下的 Cookie。
- 有效期，一旦超过有效期，Cookie就会失效。
```js
document.cookie = "a=1; expires=Tue, 19 Feb 2019 15:22:36 GMT";
// 注意这个有效时间是格林乔治时间，可以通过 date.toGMTString() 获取。
```
- 路径
- http-only，只能在请求中使用 Cookie，在 js 中不能使用 Cookie。
- secure，只能在 https 协议下，才能使用
- samesite，第三方网站能否使用 Cookie

## Cookies作用
- 存储个性化设置。
- 存储未登录时用户唯一标识。
- 存储已登录用户的凭证。
  - 用户ID，仅使用用户ID作为用户凭证，会存在巨大的安全的隐患。
  - 用户ID + 签名。
  - SessionId
- 存储其他业务数据。

## Cookies与XSS的关系
- XSS可能偷取Cookies
- http-only的Cookie不会被偷

## Cookies与CSRF的关系
- CSRF利用了用户Cookies
- 攻击站点无法读写Cookies

## Cookies安全策略
- 签名防篡改
- 私有变换（加密）
- http-only（防止XSS）
- secure
- same-site
