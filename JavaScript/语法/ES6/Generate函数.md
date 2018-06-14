## Generate 函数

### Generate 函数语法
```
function* g() {
    yield 'a';
    yield 'b';
    yield 'c';
    return 'ending';
}
g(); // 返回一个对象
```

1. Generator 函数神奇之一：g()并不执行g函数.  
g()并不会执行g函数，返回的也不是函数运行结果，而是一个指向内部状态的指针对象，也就是迭代器对象（Iterator Object）。

2. Generator 函数神奇之二：分段执行  
gen.next()返回一个非常非常简单的对象{value: "a", done: false}，'a'就是g函数执行到第一个yield语句之后得到的值，false表示g函数还没有执行完，只是在这暂停。

3. Generator 函数的特点就是：
- 分段执行，可以暂停
- 可以控制阶段和每个阶段的返回值
- 可以知道是否执行到结尾

### yield 语句
注意：yield语句只能用于function*的作用域，如果function*的内部还定义了其他的普通函数，则函数内部不允许使用yield语句。

### next 方法
next() 方法可以传入一个参数，这个参数会作为上一个 yield 的返回值。
```
function* generator() {
    var a = yield 'this is a generator';
    console.log(a);
    yield a+1;
}
var g = generator();
g.next(); // {value: "this is a generator", done: false}
g.next(2);
// 2
// {value: 3, done: false}
```

### for...of循环
for...of循环可以自动遍历Generator函数时生成的Iterator对象，且此时不再需要调用next方法。
```
for (let v of g()) {
  console.log(v);
}
// a b c
```
注意：一旦next方法的返回对象的done属性为true，for...of循环就会中止，且不包含该返回对象，所以上面代码的return语句返回的ending，不包括在for...of循环之中。

### 使用 Generate 实现异步操作
Generator函数的一个重要实际意义就是用来处理异步操作，改写回调函数。
```
function request(url) {
    // 请求完成后，调用 next
    makeAjaxCall( url, function(response){
        it.next( response );
    } );
    // Note: nothing returned here!
}

function *main() {
    var result1 = yield request( "http://some.url.1" );
    var data = JSON.parse( result1 );

    var result2 = yield request( "http://some.url.2?id=" + data.id );
    var resp = JSON.parse( result2 );
    console.log( "The value you asked for: " + resp.value );
}

var it = main();
it.next(); // get it all started
```

### 参考文档
- [理解 ES6 Generator 函数](https://www.jianshu.com/p/e0778b004596)
- [通过ES6 Generator函数实现异步流程](https://segmentfault.com/a/1190000010744559)