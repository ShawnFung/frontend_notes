# let 和 const

## 参考文档
- [ES6 系列之 let 和 const](https://github.com/mqyqingfeng/Blog/issues/82)

## let 声明
| 对比项 | let | var |
| ------ | --- | --- |
| 作用域 | 块作用域 | 函数作用域 |
| 是否会进行变量提升 | 否 | 是 |
| 是否可以重复声明 | 否 | 是 |
| 是否绑定全局作用域 | 否 | 是 |

### 循环中的块级作用域
for 循环头部的 let i 不只为 for 循环本身声明了一个 i，而是为循环的每一次迭代都重新
声明了一个新的 i。这意味着 loop 迭代内部创建的闭包封闭的是每次迭代中的变量。
```
var funcs = [];
for (let i = 0; i < 5; i++) {
  funcs.push( function(){
    console.log( i );
  });
}
funcs[3](); // 3

var funcs = [];
for (var i = 0; i < 5; i++) {
  funcs.push( function(){
    console.log( i );
  });
}
funcs[3](); // 5
```

### let不会被提升
 let声明不会被提升到当前执行上下文的顶部。在块中的变量初始化之前，引用它将会导致 ReferenceError（而使用 var 声明变量则恰恰相反，该变量的值是 undefined ）。
```
function do_something() {
  console.log(bar); // undefined
  console.log(foo); // ReferenceError: foo is not defined
  var bar = 1;
  let foo = 2;
}
```

### 重复声明报错
在相同的函数或块作用域内重新声明同一个变量会引发SyntaxError。
```
if (x) {
  let foo;
  let foo; // Uncaught ReferenceError: value is not defined
}
```

### 不绑定全局作用域
当在全局作用域中使用 var 声明的时候，会创建一个新的全局变量作为全局对象的属性。
```js
var value = 1;
console.log(window.value); // 1
```
然而 let 和 const 不会：
```js
let value = 1;
console.log(window.value); // undefined
```

## const 声明
用于创建常量。  
常量不是对这个值本身的限制，而是对赋值的那个变量的限制。
```
{
  const a = [1,2,3];
  a.push( 4 );
  console.log( a ); // [1,2,3,4]
  a = 42; // TypeError!
}
```

## Questions
1. let 与 var 的区别？
