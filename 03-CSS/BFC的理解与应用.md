# BFC的理解与应用
BFC 即 Block Formatting Contexts (块级格式化上下文)，BFC是一个独立的布局环境，BFC内部的元素布局与外部互不影响。

## 如何创建BFC？
- 根元素
- `position: absolute/fixed`
- `display: inline-block、table-cell、flex`
- `float` 元素
- `ovevflow` !== `visible`

## BFC的特性
- 属于同一个 BFC 的两个相邻的 Box 的 margin 会发生重叠。【应用1】
- BFC 的区域不会与 float 的元素区域重叠。【应用2】
- 计算 BFC 高度时，浮动元素也参与计算。【应用3】
- BFC容器里面的元素不会在布局上影响到外面的元素。

## BFC的应用：
1. 防止 margin 重叠
2. 自适应多栏布局、左图右文效果
```html
<img src='image.png' style="float:left">
<p style="overflow:hidden">我是超长的文字<p>
```
3. 清除浮动

## 参考文档
- [块格式化上下文](https://developer.mozilla.org/zh-CN/docs/Web/Guide/CSS/Block_formatting_context)
- [10 分钟理解 BFC 原理](https://zhuanlan.zhihu.com/p/25321647)

