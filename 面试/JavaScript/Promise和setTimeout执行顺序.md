# Promise和setTimeout执行顺序

## 参考文档
- [关于第10题的一些见解](https://github.com/Advanced-Frontend/Daily-Interview-Question/issues/7)

## 总结
处理这种异步笔试题的重点就在于：将不同的任务放到不同的任务队列中。浏览器依次执行[主线程] -> [microtask] -> [macrotask]
- 主线程，所有立即执行的任务，都放到主线程中。
- microtask 任务队列，Promise.then、await 都放到 microtask 任务队列。
- macrotask 任务队列，setTimeout、setInterval 都放到 macrotask 任务队列。  

## 笔试题1
```js
setTimeout(function() {
    console.log(1)
}, 0);
new Promise(function(a, b) {
    console.log(2);
    for(var i = 0; i < 10; i++) {
        i == 9 && a();
    }
    console.log(3);
}).then(function() {
    console.log(4)
});
console.log(5)
// 2 3 5 4 1
```

### 分析
- Promise 被定义后是立即执行的。
- setTimeout(fn, 0) 在下一轮“事件循环”开始时执行，属于macrotask。
- Promise.then() 在本轮“事件循环”结束时执行，属于microtask。

## 笔试题2
```js
async function async1() {
    console.log('async1 start');
    await async2();
    console.log('async1 end');
}
async function async2() {
    console.log('async2');
}
console.log('script start');
setTimeout(function() {
    console.log('setTimeout');
}, 0)
async1();
new Promise(function(resolve) {
    console.log('promise1');
    resolve();
}).then(function() {
    console.log('promise2');
});
console.log('script end');
```

### 分析
- await出现之前的代码是立即执行的。
- await后面的表达式也是立即执行的。
- await是一个让出线程的标志。将await后面的代码加入到 microtask 中。
- async await 本身就是 promise+generator 的语法糖
```js
async function async1() {
	console.log('async1 start');
	await async2();
	console.log('async1 end');
}
// 等价于
async function async1() {
	console.log('async1 start');
	Promise.resolve(async2()).then(() => {
      console.log('async1 end');
  })
}
```

