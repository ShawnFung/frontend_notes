# javascript 事件机制
- DOM事件的级别
- DOM事件模型，包括捕获和冒泡
- DOM事件流
- 描述DOM事件捕获的具体流程
- Event对象的常见应用
- 自定义事件

## 事件级别
- DOM0  element.onclick = function(){}
- DOM2  element.addEventListener('click', function, false)
- DOM3  element.addEventListener('click', function, false)

## DOM2级事件流
![DOM2级事件流](../../images/javascript事件机制_1.png)  
DOM2级事件流包括三个阶段：
1. 事件捕获阶段。window --> document --> html --> body --> ... -> 目标元素
2. 处于目标阶段。当target与currentTarget相等了，则到达目标元素。
3. 事件冒泡阶段。目标元素 --> ... --> body --> html --> document --> window
```
element.addEventListener(event, function, useCapture);
useCapture 可选。布尔值，指定事件是否在捕获或冒泡阶段执行。
  可能值:
  true： 事件句柄在捕获阶段执行。
  false：默认，事件句柄在冒泡阶段执行。
```

## Event对象的常见应用
- event.target 触发事件的对象
- event.currentTarget 绑定事件的元素
- preventDefault 阻止事件的默认行为，cancelable是true时可以使用
- stopPropagation 取消事件捕获/冒泡，bubbles为true才能使用
- stopImmediatePropagation 阻止事件冒泡并且阻止相同事件的其他侦听器被调用。

## [自定义事件](https://www.cnblogs.com/shapeY/p/7923353.html)
- Event() 构造函数, 创建一个新的事件对象 Event, IE 不支持
- CustomEvent()  在 Event() 的基础上，允许传递额外参数, IE 不支持
- document.createEvent() 创建一个新的事件（Event），随之必须调用自身的 init 方法进行初始化。

```js
var customEvent = new Event('custom')
document.addEventListener('custom',function(e){
  console.log('触发自定义事件')
})
document.dispatchEvent(customEvent)
```

## 移动端事件
### 移动端会多点触屏
- touches 屏幕上所有手指的信息
- targetTouches 目标区域的手指信息
- changedTouches 最近一次触发该事件的手指信息

### 300ms延迟

## 参考文档
- [javascript事件机制详解（涉及移动兼容）](http://www.cnblogs.com/yexiaochai/p/3462657.html)



