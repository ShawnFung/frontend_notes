# http-proxy-middleware 代理中间件
[官方文档](https://github.com/chimurai/http-proxy-middleware)
```
npm install --save-dev http-proxy-middleware
```

## 使用
```
proxy([context,] options)
context: 需要被代理的路径
options: 选项
如：
proxy: {
    '/vcloudwood/': {
        target: 'http://192.168.1.198:22224',   // 代理的目标地址
        changeOrigin: true,
        secure: false
    }
}
```

## 常用 options
### cookiePathRewrite 重写cookie路径
使用场景：
- 后台api配置了二级域名，如：192.168.1.101:8080/wyxd
- 而且后端把登录之后设置的cookie也设置了path：Path='/wyxd'
在这种情况下，当前端地址为 localhost:8080 时，是读取不到 /wyxd 下的 cookie 的，导致前端登录每次都通过，但就是不能正常调api，每次调取都提示没有登录。  

解决方案：重写cookie路径就好了
```
cookiePathRewrite: { '/wyxd': '' }
```
