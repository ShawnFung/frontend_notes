# babel-polyfill 或 babel-polyfill

## 参考文档
- [babel-polyfill使用与性能优化](https://www.colabug.com/2985798.html)
- [@babel/polyfill 总结](https://segmentfault.com/a/1190000017457575?utm_source=tag-newest)

## 什么是babel-polyfill
babel只负责语法转换，比如将ES6的语法转换成ES5。但如果有些对象、方法，浏览器本身不支持，比如：
- 全局对象：Promise、WeakMap 等。
- 全局静态函数：Array.from、Object.assign 等。
- 实例方法：比如 Array.prototype.includes 等。

此时，需要引入 babel-polyfill 来模拟实现这些对象、方法。 
 
babel-polyfill 主要包含两部分：
- [regenerator](https://github.com/facebook/regenerator/blob/master/packages/regenerator-runtime/runtime.js)：提供generator支持，如果应用代码中用到generator、async函数的话用到。
- [core-js](https://github.com/zloirock/core-js)：提供了如ES5、ES6、ES7等规范中新定义的各种对象、方法的模拟实现。

## 安装
```
npm install --save babel-polyfill
```

## 使用
你需要在你应用的 entry point 的头部引入它，确保它在，其他代码或者引用之前，被调用。
```js
// 假设入口文件是 index.js
require('babel-polyfill');
// 或者
import "babel-polyfill";
```
- 没有使用 babel-preset-env 的话，需要在你应用的入口文件顶部通过 require 或者 import 引入 babel-polyfill。
- 和 babel-preset-env 一起用
  - 如果在 .babelrc 中指定 useBuiltIns: 'usage' 的话，那么就不要在 webpack.config.js 的 entry array 和 source 中包含 babel-polyfill 了。注意，babel-polyfill 依然需要安装。
  - 如果在 .babelrc 中指定 useBuiltIns: 'entry' 的话，需要在你应用的入口文件顶部通过 require 或者 import 引入 babel-polyfill。
  - 如果在 .babelrc 中没有指定 useBuiltIns 的值或者设置 useBuiltIns: false。可以直接在 webpack.config.js 的 entry array 中添加 babel-polyfill。
  ```
  module.exports = {
      entry: ['babel-polyfill', './app']
  }
  ```

## 按需加载
