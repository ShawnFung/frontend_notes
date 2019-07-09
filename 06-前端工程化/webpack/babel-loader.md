# Babel

- @babel/core，Babel编译器的核心，如果要使用babel-loader进行es6的转码你首先必须得安装@babel/core
- babel-loader，让Webpack能够使用Babel，编译ES6
- @babel/preset-env，编译插件，指导Babel如何去编译ES6语法

Babel只负责语法转换。针对浏览器不支持的对象、方法，需要使用 polyfill。
- 方案一，使用 @babel/polyfill，会污染全局环境，可以在业务代码中使用。
- 方案二，使用 @babel/plugin-transform-runtime，不会污染全局环境，可以在第三方类库中使用。

## Preset
### Official Presets(正式的Presets)
- env
    可以替代 es2015, es2016, es2017 and latest
- react
- flow

### Stage-X (Experimental Presets) (实验性 Presets)
一旦 TC39 会议变更了提案，stage-x presets 也会相应改变，所以使用实验性 Presets，要特别注意。
- Stage 0 - Strawman: 就是一个想法
- Stage 1 - Proposal: 提案，后续可能跟进
- Stage 2 - Draft: 草稿阶段，有初步的说明
- Stage 3 - Candidate: 完成说明文档，并开始浏览器实现
- Stage 4 - Finished: 将在明年发布

## @babel/polyfill
缺点： @babel/polyfill 是通过向全局对象和内置对象的prototype上添加方法实现的，会造成全局变量污染。

针对浏览器不支持的对象、方法，需要引入 @babel/polyfill 来模拟实现。
- 全局对象：Promise、WeakMap 等。
- 全局静态函数：Array.from、Object.assign 等。
- 实例方法：比如 Array.prototype.includes 等。

@babel/polyfill 主要包含两部分：
- [regenerator](https://github.com/facebook/regenerator/blob/master/packages/regenerator-runtime/runtime.js)：提供generator支持，如果应用代码中用到generator、async函数的话用到。
- [core-js](https://github.com/zloirock/core-js)：提供了如ES5、ES6、ES7等规范中新定义的各种对象、方法的模拟实现。

安装
```
npm install --save @babel/polyfill
```

## 使用
- 没有使用 @babel/preset-env 的话
，需要在你应用的入口文件顶部通过 require 或者 import 引入 @babel/polyfill。
```js
// 假设入口文件是 index.js
require('@babel/polyfill');
// 或者
import "@babel/polyfill";
```
- 在 entry array 中添加 @babel/polyfill
```
module.exports = {
  entry: ['@babel/polyfill', './app']
}
```
- 和 @babel/preset-env 一起用
```js
// babel.config.js
module.exports = {
  presets: [
    ['@babel/preset-env', { 
      "targets": {
        "browsers": ["> 1%", "last 2 versions", "not ie <= 8"]
      },
      "useBuiltIns": 'usage'
    }]
  ]
}
```
- useBuiltIns: 'usage'，Babel 会根据实际代码中使用的ES6/ES7代码，以及与你指定的targets，按需引入对应的 polyfill，而无需在代码中直接引入 import '@babel/polyfill'，避免输出的包过大，同时又可以放心使用各种新语法特性。
- useBuiltIns: 'entry' 的话，需要在你应用的入口文件顶部通过 require 或者 import 引入 @babel/polyfill。

## [@babel/plugin-transform-runtime](https://babeljs.io/docs/en/babel-plugin-transform-runtime)
transform-runtime，它在编译过程中只是将需要polyfill的代码引入了一个指向 core-js 中对应模块的链接(alias)，不会产生全局污染。

- 安装
```
npm install --save-dev @babel/plugin-transform-runtime
npm install --save @babel/runtime
```
- 使用
```js
// babel.config.js
module.exports = {
  "plugins": [
    [
      "@babel/plugin-transform-runtime",
      {
        "corejs": 2,  // 需要安装 npm install --save @babel/runtime-corejs2
        "helpers": true,
        "regenerator": true,
        "useESModules": false
      }
    ]
  ]
}
```

## 常见问题
1. vuejs中使用（...）对象扩展运算符报错？  
错误描述：
```
{
  "presets": ["env"]
}

Module build failed: SyntaxError: D:/projects/mars_sky_eye_client1/src/libs/iview_index.js: Unexpected token (49:8)

  47 | function test(){
  48 |     return {
> 49 |         ...a
     |         ^
  50 |     }
  51 | }
  52 | 
```

解决方案：  
    对象扩展运算符，目前仍属于 stage-3，所以需要增加 stage-3 支持。babel-preset-env 不包含实验性的语法。
```
.babelrc
{
  "presets": ["env", "stage-3"]
}
```


## 参考文档：
- [vuejs中使用（...）对象扩展运算符报错？](https://segmentfault.com/q/1010000008028037)
- [babel-polyfill使用与性能优化](https://www.colabug.com/2985798.html)
- [@babel/polyfill 总结](https://segmentfault.com/a/1190000017457575?utm_source=tag-newest)
- [使用 webpack 4 和 Babel 7 配置 Vue.js 工程模板](https://segmentfault.com/a/1190000015247255?utm_source=tag-newest)