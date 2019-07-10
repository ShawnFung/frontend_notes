# webpack 核心概念

## Questions？
- webpack-cli 有什么用？

## Entry和Output
```
{
  entry: {
    main: './src/index.js'
  },
  output: {
    publicPath: 'https://cdn.example.com/assets/',  // 静态资源最终访问路径 = output.publicPath + 资源loader或插件等配置的路径
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist')   // 打包后文件的输出目录，即文件在硬盘中的存储位置
  }
}
```
- output.filename 当 entry 中配置的入口文件 > 1 时，需要使用占位符

## [Loader](https://webpack.js.org/loaders/)
- webpack 默认只知道如何打包 js 文件，如果需要处理其他类型的文件，则需使用各种 loader。
- loader的执行的顺序是：从下到上，从右到左。
```js
import avatar from './avatar.png';  // 引入图片，avatar的值是图片的路径
import './index.css';   // 引入css文件
```

### Files
- file-loader，可以解析项目中的url引入（不仅限于css），根据我们的配置，将图片拷贝到相应的路径，并修改打包后文件引用路径，使之指向正确的文件。常用于图片、字体等文件的打包。
- url-loader，提供了一个limit参数，小于limit字节的文件会被转为DataURl，大于limit的还是会使用file-loader进行copy。
    - url-loader内置了file-loader，因此使用url-loader时，只需要安装url-loader即可，不需要安装file-loader。

### Styling
- style-loader 通过添加```<style>```标签，将 CSS 内容挂载到页面上，
- css-loader
  - importLoaders
  - modules 是否启用 CSS Modules。
- sass-loader 加载 sass/scss 文件，并将其解析成 CSS。
- less-loader 加载 less 文件，并将其解析成 CSS。
- postcss-loader 让webpack能够使用 PostCSS 去处理 CSS

### 使用Babel处理ES6语法
[安装](https://babeljs.io/setup#installation)
```
npm install --save-dev babel-loader @babel/core @babel/preset-env
```
使用：
```js
module: {
  rules: [
    {
      test: /\.js$/,
      exclude: /node_modules/,
      use: {
        loader: 'babel-loader',
        options: {
          presets: [['@babel/preset-env', {
            useBuiltIns: 'usage'  
          }]]
        }
      }
    }
  ]
}
```

## plugins
- HtmlWebpackPlugin，会在打包结束后，自动生成一个 html 文件，并把打包生成的 js 自动引入到这个 html 文件中。
  - template，html模板文件的路径
- CleanWebpackPlugin 用于删除/清理构建文件夹

## devtool 与 sourceMap
- source-map，会生成一个 .js.map 文件
- cheap，与source-map的区别在于cheap生成的.map文件会忽略原始代码中的列信息。
- inline，与source-map不同，增加inline属性后，不会生成独立的.map文件，而是将.map文件以dataURL的形式插入到bundle中。
- module？
- eval，eval模式会把每个 module 封装到 eval 里包裹起来执行，并且会在末尾追加注释。
```
webpackJsonp([1],[
  function(module,exports,__webpack_require__){
    eval(
      ...
      //# sourceURL=webpack:///./src/js/index.js?'
    )
  }
...])
```
推荐：
- 开发环境：cheap-module-eval-source-map
- 生产环境：cheap-module-source-map

## webpack-dev-server
注意：使用前需要先安装 webpack-dev-server。
```js
// webpack.config.js
var path = require('path');
module.exports = {
  devServer: {
    contentBase: path.join(__dirname, 'dist'),
    compress: true,
    port: 9000
  }
};
```
package.json
```
"scripts": {
  "start": "webpack-dev-server --open",
}
```

## Hot Module Replacement
```js
module.exports = {
  devServer: {
    hot: true,  
    hotOnly: true
  },
  plugins: [
    new webpack.HotModuleReplacementPlugin({
      // Options...
    })
  ]
};
```

## Development和Production模式区分打包
- webpack.common.js 公共配置文件
- webpack.dev.js  开发模式配置文件
- webpack.prod.js 生产模式配置文件
```js
// 以 webpack.dev.js 为例
import merge from 'webpack-merge';  // 使用 webpack-merge 合并多个配置文件
const commConfig = require("./config/webpack.common.js");
const developmentConfig = {
  // ...
}
module.exports = merge(commConfig, developmentConfig)
```
```
{
  "scripts": {
    "dev": "webpack-dev-server --config ./config/webpack.dev.js",
    "build": "webpack --config ./config/webpack.dev.js"
  }
}
```

## 参考文档
- [Asset Management](https://webpack.js.org/guides/asset-management/)

