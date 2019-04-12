# Drag And Drop
Internet Explorer 9+

## 参考文档
1. [HTML5魔法堂：全面理解Drag & Drop API](http://www.cnblogs.com/fsjohnhuang/p/3961066.html)

## 拖拽目标
首先设置元素为可拖放：draggable="true"。
```html
<div draggable="true"></div>
```
## 事件
拖放API有8个事件，其中有3个事件绑定在拖拽目标上，有5个事件绑定在放置目标上。
- 在拖动目标上触发事件 (源元素):
  - ondragstart：用户开始拖动元素时触发
  - ondrag：元素正在拖动时触发
  - ondragend：用户完成元素拖动后触发
- 释放目标时触发的事件:
  - ondragenter：当被鼠标拖动的对象进入其容器范围内时触发此事件
  - ondragover：当某被拖动的对象在另一对象容器范围内拖动时触发此事件
  - ondragleave：当被鼠标拖动的对象离开其容器范围内时触发此事件
  - ondragexist：Firefox 特有，可忽略。
  - ondrop：在一个拖动过程中，释放鼠标键时触发此事件
整个声明周期如下：  
 dragstart -> drag -> dragenter -> dragover ->  dragleave  -> drop -> dragend 
 
 ## DataTransfer对象
每个event事件对象中都会有DataTransfer对象，用来保存被拖动的数据。  
注意事项：
- 只能在dragstart事件中调用setData; 在drop事件中调用getData; 这是由操作权限所决定的。
```js
document.getElementById('source').ondragstart = function (event) {
    event.dataTransfer.setData('some-key', 'some-value');
};
document.getElementById('target').ondrop = function(event){
    event.preventDefault(); // 拖动的默认处理方式是在新窗口打开，所以阻止其执行
    let value = event.dataTransfer.getData('some-key');
}
```
- 调用drop之前一定要先调用dragover,不管你想不想用，并且在处理函数的第一行加上：event.preventDefault();表示允许放下元素。

 
