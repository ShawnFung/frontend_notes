# 聊一聊 Babel
Babel 是一个工具链，主要用于将 ECMAScript 2015+ 版本的代码转换为向后兼容的 JavaScript 语法，以便能够运行在当前和旧版本的浏览器或其他环境中。
- [AST Explorer](https://astexplorer.net/) - 实时编辑看AST，还带高亮
- [Javascript 可视化分词](https://resources.jointjs.com/demos/javascript-ast)

## Babel 工作流程
- Parse解析: 将代码(其实就是字符串)转换成 AST( 抽象语法树)
  - 词法分析Tokenizer: 将代码(字符串)分割为token流,即语法单元成的数组
  - 语法分析: 分析token流(上面生成的数组)并生成 AST
- Transform转换: 访问 AST 的节点进行变换操作生成新的 AST
- Generate生成: 以新的 AST 为基础生成代码

## Babel 都有哪些库
- @babel/core：读取代码、生成AST、转换、重新生成代码的流程都是由 @babel/core 模块来控制的，它通过调用其他模块来完成 babel 的整个转换。
- @babel/cli：CLI命令行工具
- @babel/parser：Babel 的解析器。
- @babel/traverse：负责维护整棵树的状态，并且负责替换、移除和添加节点
- @babel/types：一个用于 AST 节点的 Lodash 式工具库， 它包含了构造、验证以及变换 AST 节点的方法。
- @babel/generator：- Babel 的代码生成器，它读取 AST 并将其转换为代码和源码映射（sourcemaps）。
- @babel/template
- @babel/plugin-*：Babel 插件，包括语法插件和转换插件。
- @babel/polyfill：处理API兼容。polyfill 体积太大，需要通过preset的useBuiltIns来实现按需加载。
- @babel/runtime：

## Babel plugins 插件
Babel只是转换syntax层语法
- 转换插件：将启用相应的语法插件，用于转换你的代码。（因此你不必同时指定这两种插件）
  - @babel/plugin-transform-*：普通的转换插件
  - @babel/plugin-proposal-*： 还在'提议阶段'(非正式)的语言特性
- 语法插件 @babel/plugin-syntax-*：这些插件只允许 Babel 解析（parse） 特定类型的语法（而不是转换）。

## 预设（Presets）
通过使用或创建一个 preset 即可轻松使用一组插件。 
presets与plugins同时存在的执行顺序：
- plugins运行在presets之前；
- plugins配置项，按照声明顺序执行，从第一个到最后一个；
- presets配置项，按照声明逆序执行，从最后一个到第一个（主要是为了确保向后兼容）

## Babel Polyfill
@babel/polyfill用于处理API兼容，因为polyfill体积太大，所以通过preset的useBuiltIns来实现按需加载。
- core-js 是 @babel/polyfill 的底层依赖。

## Babel runtime
为了满足npm组件开发的需要出现了@babe/runtime来做隔离。

## 配置 Babel
```
//.babelrc
{
    "plugins": ["@babel/plugin-transform-arrow-functions"]
}
```

## 访问者模式
转换器操作 AST 一般都是使用访问器模式，由这个访问者(Visitor)来 ① 进行统一的遍历操作，② 提供节点的操作方法，③ 响应式维护节点之间的关系；而插件(设计模式中称为‘具体访问者’)只需要定义自己感兴趣的节点类型，当访问者访问到对应节点时，就调用插件的访问(visit)方法。  
我们可以对 AST 进行任意的操作，比如删除父节点的兄弟节点、删除第一个子节点、新增兄弟节点... 当这些操作'污染'了 AST 树后，访问者需要记录这些状态，响应式(Reactive)更新 Path 对象的关联关系, 保证正确的遍历顺序，从而获得正确的转译结果。

## 参考文档
- [面试官: 聊一聊Babel](https://segmentfault.com/a/1190000020475592)
- [从0到1开发并测试Babel插件&Babel简易源码分析](https://juejin.cn/post/6844904162237366279)
- [the-super-tiny-compiler](https://github.com/jamiebuilds/the-super-tiny-compiler)
- [深入浅出 Babel 上篇：架构和原理 + 实战](https://juejin.cn/post/6844903956905197576)
- [不容错过的 Babel7 知识](https://juejin.cn/post/6844904008679686152)
