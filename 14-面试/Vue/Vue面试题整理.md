# Vue面试题整理

## MVVM

## 生命周期
### [说一下Vue的生命周期](https://juejin.im/post/5e649e3e5188252c06113021#heading-5)
- beforeCreate
- created
- beforeMount
- mounted
- beforeUpdate
- updated
- beforeDestroy
- destroyed

### 你的接口请求一般放在哪个生命周期中？
接口请求一般放在mounted中，但需要注意的是服务端渲染时不支持mounted，需要放到created中

### Vue中组件生命周期调用顺序说一下
- 加载渲染过程  
父beforeCreate->父created->父beforeMount->子beforeCreate->子created->子beforeMount- >子mounted->父mounted
- 子组件更新过程  
父beforeUpdate->子beforeUpdate->子updated->父updated
- 父组件更新过程  
父beforeUpdate ->父updated
- 销毁过程  
父beforeDestroy->子beforeDestroy->子destroyed->父destroyed

## 数据绑定
### 简单说一下Vue2.x响应式数据原理

### 简单说一下Vue3.x响应式数据原理

## 组件通信
- 父->子props，子->父 $on、$emit
- 获取父子组件实例 $parent、$children
- Ref 获取实例的方式调用组件的属性或者方法
- Provide、inject
- Event Bus
- Vuex
- $attrs、$listeners

## Virtual DOM
Virtual DOM本质就是用一个原生的JS对象去描述一个DOM节点，是对真实DOM的一层抽象。(也就是源码中的VNode类，它定义在src/core/vdom/vnode.js中。)  

虚拟 DOM 的优势：
- diff 算法，减少 JavaScript 操作真实 DOM 的带来的性能消耗。
- 抽象了原本的渲染过程，实现了跨平台的能力，而不仅仅局限于浏览器的 DOM，可以是安卓和 IOS 的原生组件，可以是近期很火热的小程序，也可以是各种GUI。

## 参考文档
- [Vue面试题整理](https://juejin.im/post/5e649e3e5188252c06113021)
- [虚拟 DOM 到底是什么？](https://mp.weixin.qq.com/s/oAlVmZ4Hbt2VhOwFEkNEhw)
