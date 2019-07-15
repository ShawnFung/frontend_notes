# Tree-shaking
Tree-shaking的本质是消除无用的js代码。

## Questions？
- Webpack中如何使用 tree-shaking？
- Webpack tree-shaking能消除哪些无用代码？

## 原理
tree-shaking的消除原理是依赖于ES6的模块特性。ES6模块依赖关系是确定的，和运行时的状态无关，可以进行可靠的静态分析。
- 只能作为模块顶层的语句出现
- import 的模块名只能是字符串常量
- import binding 是 immutable的

## 第三方库与Tree-shaking
- vue.js vue.js在打包的时候是否使用了 tree-shaking？从 package.json 文件来看，里面添加了 "sideEffects" 属性
- element-ui
- vue 单文件
- 如果使用了 tree shaking，需要设置 sideEffects: ['*.css'] 将 css 排除。

## 结论
- 使用 ES2015 模块语法（即 import 和 export）。
- 确保没有 compiler 将 ES2015 模块语法转换为 CommonJS 模块（这也是流行的 Babel preset 中 @babel/preset-env 的默认行为 - 更多详细信息请查看 文档）。
- 在项目 package.json 文件中，添加一个 "sideEffects" 属性。
- 通过将 mode 选项设置为 production，启用 minification(代码压缩) 和 tree shaking。


