# Vue.js 设计与实现

## 第一章
虚拟 DOM 的性能，并给出了一个公式：声明式的更新性能消耗 = 找出差异的性能消耗 + 直接修改的性能消耗。
虚拟 DOM 的意义就在于使找出差异的性能消耗最小化。

## 第二章 框架设计的核心要素
**提升用户的开发体验**
- 提供友好的警告信息至关重要。
- 控制台输出结果优化：谷歌开发者工具，打开 DevTools 的设置，然后勾选“Console”→“Enable custom formatters”选项，可以更直观查看打印的数据。

**控制框架代码的体积**
```js
if (__DEV__ && !res) {
  warn(`Failed to mount app: Mount target selector "${container}" returned null.`);
}
```
在 vue3 源码中会看到 warn 函数调用会配合__DEV__检查，这里的__DEV__常量是通过 rollup.js 的插件配置来预定义的，类似于 webpack 中的 DefinePlugin，就是在编译的时候通过静态变量替换成 true 或者 false，替换成 false 而永远不会执行的代码就是 dead code，它不会出现在最终产物中。这样我们就做到了在开发环境中为用户提供优化的警告信息的同时，不会增加生产环境代码的体积。

**框架要做到良好的 Tree-Shaking**
简单地说，Tree-Shaking 指的就是消除那些永远不会被执行的代码，也就是排除 dead code，现在无论是 rollup.js 还是 webpack，都支持 Tree-Shaking。
Tree-Shaking 的两个要点：
- 模块必须是 ESM（ES Module），因为 Tree-Shaking 依赖 ESM 的静态结构。
- 副作用。如果一个函数调用会产生副作用，那么就不能将其移除。副作用就是，当调用函数的时候会对外部产生影响，例如修改了全局变量。可以通过 `/*#__PURE__*/`注释，来告诉打包工具，xx函数的调用不会产生副作用

**框架应该输出怎样的构建产物**
rollup 中可以配置 output.format 为 amd，cjs，system，esm，iife，umd。
- iife 格式，支持 script 标签引入。`<script src="/path/to/vue.js"></script>`
- esm 格式，支持 `<script type="module">` 标签引入。
- cjs 格式，CommonJS 并不是在浏览器环境运行的规范，而是在 node.js 环境下运行的。

**特性开关**
用户可以通过设置`__VUE_OPTIONS_API__`预定义常量的值来控制是否要包含*组件选项 API*代码。默认为 true
- webpack
``` js
new webpack.DefinePlugin({
  __VUE_OPTIONS_API__: JSON.stringify(false) // 关闭特性
})
```
- vite
```js
define: {
  __VUE_OPTIONS_API__: false   // 关闭 Vue2 中的 options 选项API
},
```

**错误处理**
- [给你的库或框架设计一个通用错误处理模型](https://juejin.cn/post/7088699786886397989)

**良好的 TypeScript 类型支持**

## 第三章 Vue.js 3 的设计思路
- 虚拟 DOM 就是用来描述真实 DOM 的普通 JavaScript 对象
- 渲染器会把虚拟 DOM 渲染为真实 DOM 元素。它的工作原理是，递归地遍历虚拟 DOM 对象，并调用原生 DOM API 来完成真实 DOM 的创建。渲染器的精髓在于后续的更新，它会通过 Diff 算法找出变更点，并且只会更新需要更新的内容。
- 编译器的作用其实就是将模板编译为渲染函数。

## 第四章 响应系统的作用与实现
副作用函数指的是会产生副作用的函数，xxx 函数的执行会直接或间接影响其他函数的执行，这时我们说 xxx 函数产生了副作用。  
一个响应系统的工作流程如下：
- 当**读取**操作发生时，将副作用函数收集到“桶”中，在副作用函数与被操作的目标字段之间建立明确的联系。
- 当**设置**操作发生时，从“桶”中取出副作用函数并执行。
  - 如果 trigger 触发执行的副作用函数与当前正在执行的副作用函数相同，则不触发执行。
- 桶是个树形结构
  - WeakMap 由 target --> Map 构成；
    - Map 由 key --> Set 构成。
  ```
    target1
      └── text1
        └── effectFn1
        └── effectFn2
    target2
      └── text2
        └── effectFn3
  ```
WeakMap 对 key 是弱引用，不影响垃圾回收器的工作。如果 key 对象没有任何引用了，说明用户侧不再需要它了，这时垃圾回收器会完成回收任务。  
每次副作用函数执行时，我们可以先把它从所有与之关联的依赖集合中删除。当副作用函数执行完毕后，会重新建立联系，这样新的联系中就不会包含遗留的副作用函数。
  - 依赖收集：effectFn.deps 获取所有相关联的依赖集合。
  - 依赖删除：cleanup 函数接收副作用函数作为参数，遍历副作用函数的effectFn.deps 数组，该数组的每一项都是一个依赖集合，然后将该副作用函数从依赖集合中移除，最后重置 effectFn.deps 数组。

副作用函数栈 effectStack：在副作用函数执行时，将当前副作用函数压入栈中，待副作用函数执行完毕后将其从栈中弹出，并始终让 activeEffect 指向栈顶的副作用函数。  

**调度执行**
可调度，指的是当 trigger 动作触发副作用函数重新执行时，有能力决定副作用函数执行的时机、次数以及方式。

## 第五章 非原始值的响应式方案
**理解 Proxy 与 Reflect**
什么是 Proxy？  使用 Proxy 可以创建一个代理对象。它能够实现对**其他对象**的代理。
- Proxy 只能代理对象，无法代理非对象值，例如字符串、布尔值等。
- Proxy 允许我们拦截并重新定义对一个对象的基本操作。例如 get、set、apply(拦截函数的调用操作)
```js
const data = { 
  name: "Tom",
  get value() {
    // 注意 this 的指向问题
    return this.name;
  }
}
// 对原始数据的代理
const proxy = new Proxy(data, {
  // 拦截读取操作
  // receiver 可能是代理对象的实例 proxy，也可能是继承 proxy 的那个对象，例如下面的 child 对象
  get(target, key, receiver){
    track(target, key)
    // 使用 Reflect.get 返回读取到的属性值
    // Reflect 中的 receiver 参数可以把属性访问中的 this 指向 receiver 对象，保持正确的 this 指向。
    // 直接使用 return target[key]，无法保证 this 指向问题，因此要使用 Reflect
    return Reflect.get(target, key, receiver)
  }
})
let child = { name: "小Tom" };
// 设置 child 继承 代理对象 proxy
Object.setPrototypeOf(child, proxy);
```

Reflect 反射
- Reflect.get(target, key, receiver)

**如何代理 Object**
- 对属性的读取，例如 obj.foo，可以通过 get 拦截函数实现。
- 对属性设置值，例如 obj.foo = 1，可以通过 set 拦截函数实现。
- in 操作符，例如 key in obj，可以通过 has 拦截函数实现。
- 使用 for...in 循环遍历对象，可以通过 ownKeys 拦截函数实现。
- delete 操作符，可以通过 deleteProperty 拦截函数实现。

**合理地触发响应**
- 当值没有发生变化时，应该不需要触发响应。
- 只有当 receiver是 target 的代理对象时才触发更新，这样就能屏蔽由原型引起的更新，从而避免不必要的更新操作。

**浅响应与深响应**
略

**只读和浅只读**
- 在 set、deleteProperty 拦截函数中，增加警告信息并返回
- 在 get 拦截函数中，不跟踪对应属性

**代理数组**
- 当我们通过索引读取或设置数组元素的值时，可以通过 get/set 拦截函数。
  - 当通过索引设置元素值时，可能会隐式地修改 length 的属性值。因此在触发响应时，也应该触发与 length 属性相关联的副作用函数重新执行。
  - 当修改 length 属性值时，那些索引值大于或等于新的 length 属性值的元素也需要触发响应。
- for...in 循环，同样可以使用 ownKeys 拦截函数进行拦截。使用 length 作为 key 去建立响应联系。
- 数组迭代器 for...of，数组迭代器的执行会读取数组的 length 属性。如果迭代的是数组元素值，还会读取数组的索引。只需要在副作用函数与数组的长度和索引之间建立响应联系，就能够实现响应式的 for...of 迭代。
- includes、indexOf、lastIndexOf 等查询方法，用户既可能使用代理对象进行查找，也可能使用原始对象进行查找。为了支持这两种形式，我们需要重写数组的查找方法。
- push、pop、shift、unshift 以及 splice 等方法。调用这些方法会间接地读取和设置数组的 length 属性，因此，在不同的副作用函数内对同一个数组执行上述方法，会导致多个副作用函数之间循环调用，最终导致调用栈溢出。为了解决这个问题，我们使用一个标记变量shouldTrack 来代表是否允许进行追踪，然后重写了上述这些方法，目的是，当这些方法间接读取 length 属性值时，我们会先将shouldTrack 的值设置为 false，即禁止追踪。这样就可以断开length 属性与副作用函数之间的响应联系，从而避免循环调用导致的调用栈溢出。

**5.8 代理 Set 和 Map**
未读，下次补上

## 第六章 原始值的响应式方案
**引入 ref 的概念**
JavaScript 中的 Proxy 无法提供对原始值的代理，因此想要将原始值变成响应式数据，就必须对其做一层包裹。
```js
function ref(val) {
  // 在 ref 函数内部创建包裹对象
  const wrapper = {
    value: val
  }
  // 使用 Object.defineProperty 在 wrapper 对象上定义一个不可枚举的属性 __v_isRef，并且值为 true
  Object.defineProperty(wrapper, '__v_isRef', {
    value: true
  }
  // 将包裹对象变成响应式数据
  return reactive(wrapper)
}
```

**响应丢失问题**
```vue
<template>
  <p>{{ foo }} / {{ bar }}</p>
</template>
<script>
  export default {
    setup() {
      // 响应式数据
      const obj = reactive({ foo: 1, bar: 2 })

      // 1s 后修改响应式数据的值，不会触发重新渲染
      setTimeout(() => {
        obj.foo = 100
      }, 1000)

      return {
        ...obj
      }
    }
  }
</script>
```
为什么会导致响应丢失呢？这是由展开运算符（...）导致的。可以发现，这其实就是返回了一个普通对象，它不具有任何响应式能力。把一个普通对象暴露到模板中使用，是不会在渲染函数与响应式数据之间建立响应联系的。
```js
return {
  ...obj
}
```
等价于：
```js
return {
  foo: 1,
  bar: 2
}
```
解决方案：
- 提供 toRef 函数和 toRefs 函数，支持将响应数据转成 ref 数据，这样再使用展开运算符，就不会失去响应性了。

**自动脱 ref**
在哪些是否 ref 会自动脱 ref？
- 在模板中使用 ref 数据

## 第七章 渲染器的设计
- 响应系统和渲染器之间的关系：我们利用响应系统的能力，自动调用渲染器完成页面的渲染和更新。
- 渲染器的作用是把虚拟 DOM 渲染为特定平台上的真实元素。在浏览器平台上，渲染器会把虚拟 DOM 渲染为真实 DOM 元素
- 虚拟 DOM 通常用英文 virtual DOM 来表达，有时会简写成 vdom 或 vnode。
- 渲染器把虚拟 DOM 节点渲染为真实 DOM 节点的过程叫作挂载，通常用英文 mount 来表达。
- 为了让渲染器不直接依赖浏览器平台特有的 API，我们将这些用来创建、修改和删除元素的操作抽象成可配置的对象。用户可以在调用 createRenderer 函数创建渲染器的时候指定自定义的配置对象，从而实现自定义的行为。

## 第八章 挂载与更新
- 节点的属性
  - HTML Attributes 和 DOM Properties，不能总是使用 setAttribute 函数，也不能总是通过元素的 DOM Properties 来设置。至于如何正确地为元素设置属性，取决于被设置属性的特点。
  - 特殊属性的处理
    - class，Vue 允许我们为 class 指定不同类型的值。但在把这些值设置给 DOM 元素之前，要对值进行正常化。
    - style 也是类似

## 第九章 简单 Diff 算法

## 第十四章 内建组件和模块
- KeepAlive 的本质是缓存管理，再加上特殊的挂载/卸载逻辑。
  - 当被 KeepAlive 的组件“卸载”时，渲染器并不会真的将其卸载掉，而是会将该组件搬运到一个隐藏容器中，从而使得组件可以维持当前状态。
  - 当被 KeepAlive 的组件“挂载”时，渲染器也不会真的挂载它，而是将它从隐藏容器搬运到原容器。
- Teleport 组件可以跨越 DOM 层级完成渲染。
- Transition 组件
  - 我们将过渡相关的钩子函数定义到虚拟节点的 vnode.transition 对象中。渲染器在执行挂载和卸载操作时，会优先检查该虚拟节点是否需要进行过渡，如果需要，则会在合适的时机执行 vnode.transition 对象中定义的过渡相关钩子函数。

## 第十五章 编译器
**Vue.js 模板编译器的工作流程**
模板 -> 词法分析 -> 语法分析 -> 模板AST -> Transformer -> JavaScript AST -> 代码生成 -> 渲染函数  

Vue.js 模板编译器的三个组成部分：
- 用来将模板字符串解析为模板 AST 的解析器（parser）；
- 用来将模板 AST 转换为 JavaScript AST 的转换器（transformer）；
- 用来根据 JavaScript AST 生成渲染函数代码的生成器（generator）。

## 参考文档
- [随书代码](https://github.com/Esdiarap/vuejs3Code--HcySunYang-Ver.)
