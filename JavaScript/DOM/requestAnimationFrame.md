# requestAnimationFrame
requestAnimationFrame() 方法告诉浏览器您希望执行动画，并请求浏览器调用指定的函数在下一次重绘之前更新动画。

## 特点
1. requestAnimationFrame 不需要设置时间间隔。它的最高执行频率是60FPS【大多数电脑显示器的刷新频率是60FPS，大概相当于每秒钟重绘60次】
2. requestAnimationFrame 是由浏览器专门为动画提供的API，在运行时浏览器会自动优化方法的调用，并且如果页面不是激活状态下的话，动画会自动暂停，有效节省了CPU开销。
3. 在隐藏或不可见的元素中，requestAnimationFrame将不会进行重绘或回流，这当然就意味着更少的CPU、GPU和内存使用量

## API
```js
let count = 0;
let countingFn = function() {
  count ++;
  if(count < 100){
    time = requestAnimationFrame(countingFn)
  }
}
let time = requestAnimationFrame(countingFn)
```

## 如何控制 requestAnimationFrame 回调的执行频率？
