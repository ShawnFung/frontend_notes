# Hybrid
- 如何实现 hybrid？
- hybrid 更新和上线流程
- hybrid 和 h5 的主要区别
- 前端 js 与客户端如何通讯？

## 如何实现 hybrid？
- 前端做好静态页面(js，css，html)，将文件交给客户端
- 客户端拿到前端静态页面，以文件形式存储在 app 中
- 客户端在一个 webview 中，使用 file 协议加载静态页面。

## hybrid 更新和上线流程
- 分版本，有版本号，如 201803041009
- 将静态文件压缩成 zip 包，上传到服务器
- 客户端每次启动，都去服务器检查版本号
- 如果服务器版本号大于客户端版本号，就去下载最新的 zip 包
- 下载完成之后解压，然后将现有文件覆盖

## hybrid 和 h5 的主要区别

## 前端 js 与客户端如何通讯？url Scheme
前端与客户端沟通的协议

## 参考文档
- [如何实现一个Hybrid框架](https://github.com/quickhybrid/quickhybrid/issues/12)

