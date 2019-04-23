# 如何模拟一个 new

## new 操作到底做了什么？
当代码 new Foo(...) 执行时，会发生以下事情：
1. 新生成一个空对象
2. 将空对象的__proto__属性指向构造函数的原型对象，即Foo.prototype
3. 使用指定的参数调用构造函数 Foo，其中构造函数的作用域应该是第一步创建的空对象
4. 返回新对象。如果构造函数没有显式返回一个对象，则使用步骤1创建的对象。

## 编码
```js
function create() {
  var obj = {};
  var constructor = [].shift.call(arguments);
  obj.__proto__ = constructor.prototype;
  let res = constructor.apply(obj, arguments)
  return res instanceof Object ? res : obj;
}
// 或者
function create(fn, ...arg) {
    const obj = Object.create(fn.prototype);
    const ret = fn.apply(obj, arg);
    return ret instanceof Object ? ret : obj;
}
```
