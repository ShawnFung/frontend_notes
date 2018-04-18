## Webpack 性能优化

- [查看 webpack 打包后所有的依赖关系（webpack 可视化工具）](https://blog.csdn.net/qq_16559905/article/details/78551719)  
- [webpack优化的工具](https://survivejs.com/webpack/optimizing/build-analysis/)
- [webpack-libs-optimizations](https://github.com/GoogleChromeLabs/webpack-libs-optimizations#core-js)

### 1. webpack-bundle-analyzer
![webpack-bundle-analyzer](../images/webpack-bundle-analyzer.png)

使用和安装  
```
npm install --save-dev webpack-bundle-analyzer
```  

在webpack.config.js中：
```
let BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

module.exports = {
    plugins: [new BundleAnalyzerPlugin()]
}
```
启动服务：

生产环境查看：npm run build --report 或 正常build 即可启动查看器。

开发环境查看：webpack -p --progress 或启动正常devServer服务即可启动查看器!

### 2. webpack官网提供的工具