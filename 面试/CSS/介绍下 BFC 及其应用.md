# 介绍下 BFC 及其应用

BFC 即 Block Formatting Contexts (块级格式化上下文)，具有 BFC 特性的元素可以看作是隔离了的独立容器，容器里面的元素不会在布局上影响到外面的元素，并且 BFC 具有普通容器所没有的一些特性。

## 什么情况下会创建 BFC ：
- html 根元素
- 浮动元素（元素的 float 不是 none）
- 绝对定位，position (absolute、fixed)
- 行内块元素（元素的 display 为 inline-block）
- display 为表格布局或者弹性布局
- overflow 不为 visiable 的元素
- 等等...

## BFC 的特性：
- 形成了BFC的区域不会与float box重叠。利用这一特性，1)可实现左图右文的效果。2)可以实现两列自适应布局
```html
<img src='image.png' style="float:left">
<p style="overflow:hidden">我是超长的文字<p>
```

- 计算BFC高度时，浮动元素也参与计算。利用这一特性，可以解决浮动元素造成的父元素高度塌陷问题，也就是清除浮动。
```html
<div class='parent' style="overflow:hidden;">
    <div class='float' style="float: left;">浮动元素</div>
</div>
```

- BFC容器里面的元素不会在布局上影响到外面的元素。利用这一特性，1)可以防止 margin 重叠。2)防止第一个子元素 margin-top 和父元素重叠

## 参考文档
- [块格式化上下文](https://developer.mozilla.org/zh-CN/docs/Web/Guide/CSS/Block_formatting_context)
- [10 分钟理解 BFC 原理](https://zhuanlan.zhihu.com/p/25321647)

