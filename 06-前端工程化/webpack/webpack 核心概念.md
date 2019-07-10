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


## SplitChunksPlugin 配置
打包流程：
1. 首先判断模块A，是否需要进行代码分割。
2. 然后根据 cacheGroups 的配置，判断模块A应该放到哪个组里面。
3. 如果模块A没有匹配到任何一个 cacheGroup，那么模块A就不会被分割。
```
{
  splitChunks: {
    chunks: 'all',
    cacheGroups: {
      // 只有 node_modules 下的模块会匹配到 vendors 这个组。
      vendors: {
        test: /[\\/]node_modules[\\/]/,
        priority: -10
      },
      // default 没有配置 test 属性，则所有的模块都会匹配到 default 这个组
      default: {
        minChunks: 2,
        priority: -20,
        reuseExistingChunk: true
      }
    }
  }
}
```
- chunks。async：只对异步代码进行分割，all：针对所有代码，initial：对同步代码进行分割。
- minChunks 模块被引用的次数 >= minChunks时，才会进行代码分割
- maxAsyncRequests 最大同时请求数
- maxInitialRequests 在入口文件中引入的多个模块，最多能被分割成 maxInitialRequests 个
- automaticNameDelimiter 组和文件名之间的连接符，如：vendors~main.js
- cacheGroups 需要进行代码分割的模块，到底如何分割？这就需要根据 cacheGroups 的配置来判断。
    - priority 优先级，当某个模块满足多个 cacheGroup 时，会被打包到优先级更高的组里面。
    - reuseExistingChunk 如果一个模块已经被打包过了，则不进行重复打包。
    
## Lazy loading 懒加载
- 魔法注释 /* webpackChunkName="lodash" */
- import 懒加载
```js
import(/* webpackChunkName:"lodash" */ 'lodash').then(({ default: _ }) => {
  console.log(_.join(['Dell', 'Lee']))
})
async function getComponent() {
  const { default: _ } = await import(/* webpackChunkName:"lodash" */ 'lodash')
  console.log(_.join(['Dell', 'Lee']))
}
```
- dynamicImport：babel-plugin-dynamic-import-webpack，不支持魔法注释
- plugin-syntax-dynamic-import，支持魔法注释

## 打包分析
- [analyse](https://github.com/webpack/analyse)
```
webpack --profile --json > stats.json
```
- webpack-bundle-analyzer

## 参考文档
- [Asset Management](https://webpack.js.org/guides/asset-management/)

