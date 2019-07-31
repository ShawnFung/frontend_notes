# FLIP技术

## 参考文档
- [使用 FLIP 来提高 Web 动画的性能](https://www.w3cplus.com/animation/high-performance-animations.html)

## 什么是FLIP技术？
FLIP 是将一些开销高昂的动画，如针对 width，height，left 或 top 的动画，映射为 transform 动画。  

分解一下：
- First：元素的初始状态。
- Last：元素的最终状态。
- Invert：先计算出从初始状态到最终状态元素发生的改变，比如宽度、高度、透明度等，然后在元素上应用一个 transform 或 opacity 使这些改变反转。如果一个元素由初始状态到最终状态是向下移动了 90px，那就需要对元素应用 transform: translate(0, -90px)，这样就使元素看起来还在初始位置。
- Play：移除元素上的 transform 并设置 transform 相关的动画。

## JS实现
```js
// 获取初始位置 
var first = el.getBoundingClientRect();
// 获取最终位置 
var last = el.getBoundingClientRect();
```

## CSS实现
以动画的最终位置为参考（即此时的 transform: none），计算出最终位置到初始位置发生的改变，例如最终位置向右移动 200px 就到了初始位置，那么需要对元素应用 transform: translateX(200px)，这样元素就到了初始位置。  
动画的过程就是从 transform: translateX(200px) 变成 transform: none 的过程。
```css
.element-animated {
  -webkit-animation-duration: 1s;
          animation-duration: 1s;
}
@keyframes slide-from-right {
 0% {
   -webkit-transform: translateX(200px);
           transform: translateX(200px);
 }
 100% {
   -webkit-transform: none;
           transform: none;
 }
}
.slide-from-right {
 -webkit-animation-name: slide-from-right;
         animation-name: slide-from-right;
}
```
```html
<div class="element-animated slide-from-right"></div> 
```
