# 要求设计 LazyMan 类，实现以下功能。
```js
LazyMan('Tony');
// Hi I am Tony

LazyMan('Tony').sleep(10).eat('lunch');
// Hi I am Tony
// 等待了10秒...
// I am eating lunch

LazyMan('Tony').eat('lunch').sleep(10).eat('dinner');
// Hi I am Tony
// I am eating lunch
// 等待了10秒...
// I am eating diner

LazyMan('Tony').eat('lunch').eat('dinner').sleepFirst(5).sleep(10).eat('junk food');
// Hi I am Tony
// 等待了5秒...
// I am eating lunch
// I am eating dinner
// 等待了10秒...
// I am eating junk food
```

## 参考文档
- [要求设计 LazyMan 类，实现以下功能](https://github.com/Advanced-Frontend/Daily-Interview-Question/issues/98)

## 分析
- 调用Lazyman的时候不需要用到new关键字，这意味着我们需要使用工厂函数；
```js
function Lazyman ( name ) {
    return new _Lazyman ( name );
}
```
- 链式调用
- sleepFirst优先级更高，不管何时注册，都要第一个执行。  
  明显我们需要一个任务队列，而且sleepFirst放在最前面，然后等所有任务都安排好了，才开始执行任务队列。那说明执行任务不能紧跟在插入任务全程的后面，那我们把他们分进两个事件队列就好了，这就需要借助setTimeout函数了;
  
## 编码
```js
class _Lazyman {
  constructor ( name ) {
      this.tasks = [];//设置任务队列
      console.log ( `Hi! This is ${name} !` );
      // 通过 setTimeout 的方法，将执行函数放入下一个事件队列中，从而达到先注册事件，后执行的目的
      setTimeout ( () => {
          this.next ();
      }, 0 );
  }
      
  //尾调用函数，一个任务执行完然后再调用下一个任务
  next () {
      let task = this.tasks.shift ();
      task && task ();
  }
  
  eat ( food ) {
      let task = (food => () => {
          console.log ( `Eat ${food}` );
          this.next ();
      }) ( food );
      this.tasks.push ( task );
      return this;
  }
  
  sleep ( time ) {
      let task = (time => () => {
          setTimeout ( () => {
              console.log ( `Wake up after ${time} s!` );
              this.next ();
          }, time * 1000 )
      }) ( time );
      this.tasks.push ( task );
      return this;
  }
  
  sleepFirst ( time ) {
      let task = (time => () => {
          setTimeout ( () => {
              console.log ( `Wake up after ${time} s!` );
              this.next ();
          }, time * 1000 )
      }) ( time );
      // sleepFirst函数需要最先执行，所以我们需要在任务队列前面放入，然后再执行后面的任务
      this.tasks.unshift ( task );
      return this;
  }
}
```
