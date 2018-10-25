## Webpack 4 迁移

### Webpack 新特性

####
3. 增加了 mode 配置，只有两个值development | production 

移除的功能
1. 删除了 CommonsChunkPlugin，增加了 optimization.splitChunks 和 optimization.runtimeChunk
2. 删除了 UglifyJsPlugin，只需要使用optimization.minimize为true就行
3. 删除了 ExtractTextPlugin


### 踩坑指南
compilation.templatesPlugin is not a function
npm i -D html-webpack-plugin@webpack-contrib/html-webpack-plugin



### 参考文档
- [没有了CommonsChunkPlugin，咱拿什么来分包（译）](https://segmentfault.com/a/1190000013476837)
- [Webpack 4.0 发布:有哪些新特性？（译）](https://segmentfault.com/a/1190000013608316#articleHeader2)
- [Webpack 4 不完全迁移指北](http://web.jobbole.com/93997/)
- [Webpack 3.X - 4.X 升级记录](http://blog.csdn.net/qq_16559905/article/details/79404173)
- [webpack4升级指北](https://www.imooc.com/article/23555?block_id=tuijian_wz)