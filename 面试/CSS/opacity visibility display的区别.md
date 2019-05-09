# 分析比较 opacity: 0、visibility: hidden、display: none 优劣和适用场景

- display: none
  - 元素不会渲染，不占空间，读屏器不会读取
  - 事件监听：无法进行 DOM 事件监听
  - 非继承属性，但是有株连性：一旦父节点元素应用了display:none，父节点及其子孙节点元素全部不可见，而且无论其子孙元素如何不屈地挣扎都无济于事。 
  - 性能：会造成文档回流，性能消耗较大。
  - 场景：显示出原来这里不存在的结构
- visibility: hidden
  - 元素会渲染，只是不可见，占据空间，读屏器会读取
  - 事件监听：无法进行 DOM 事件监听
  - 继承属性，子孙节点消失由于继承了hidden，通过设置visibility: visible;可以让子孙节点显示。
  - 性能：只会造成本元素的重绘，性能消耗较少
  - 场景：显示不会导致页面结构发生变动，不会撑开
- opacity: 0
  - 元素会渲染，占据空间，读屏器会读取
  - 事件监听：可以进行 DOM 事件监听
  - 非继承属性，但是有株连性：设置父元素opacity：0.5，子元素不设置opacity，子元素也会有0.5的透明度。
  - 性能：会造成重绘，性能消耗较少
  - 场景：可以跟transition搭配
  
## 参考文档
- [分析比较 opacity: 0、visibility: hidden、display: none 优劣和适用场景](https://github.com/Advanced-Frontend/Daily-Interview-Question/issues/100)
