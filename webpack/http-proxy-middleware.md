## http-proxy-middleware

### What
代理中间件

### How
[官方文档](https://github.com/chimurai/http-proxy-middleware)

#### 安装
```
npm install --save-dev http-proxy-middleware
```

#### 使用
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

#### 核心概念：路由匹配
参考官方文档的Context matching部分