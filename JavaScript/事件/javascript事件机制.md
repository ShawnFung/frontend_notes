# javascript 事件机制

## 参考文档
- [javascript事件机制详解（涉及移动兼容）](http://www.cnblogs.com/yexiaochai/p/3462657.html)

## javascript事件基础
### 事件捕获/冒泡
![DOM2级事件流](../../images/javascript事件机制_1.png)
DOM2级事件流包括三个阶段：
1. 事件捕获阶段。最先接收到事件的是 window，然后从 window 开始，向子元素传递。
2. 处于目标阶段。当target与currentTarget相等了，则到达目标元素。
3. 事件冒泡阶段。从目标元素开始，依次向父元素传递。
```
element.addEventListener(event, function, useCapture);
useCapture 可选。布尔值，指定事件是否在捕获或冒泡阶段执行。
  可能值:
  true： 事件句柄在捕获阶段执行。
  false：默认，事件句柄在冒泡阶段执行。
```

### event对象
- event.target 事件目标（绑定事件那个dom）
- event.currentTarget 某事件处理程序当前正在处理的那个元素
- preventDefault 取消事件默认行为，cancelable是true时可以使用
- stopPropagation 取消事件捕获/冒泡，bubbles为true才能使用

## 移动端事件
### 移动端会多点触屏
- touches 屏幕上所有手指的信息
- targetTouches 目标区域的手指信息
- changedTouches 最近一次触发该事件的手指信息

### 300ms延迟



