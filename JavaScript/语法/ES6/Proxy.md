# Proxy

语法：
- target 要拦截的目标对象
- handler 参数也是一个对象，用来定制拦截行为。
```js
var proxy = new Proxy(target, handler);
```
```js
var proxy = new Proxy({}, {
    get: function(obj, prop) {
        console.log('设置 get 操作')
        return obj[prop];
    },
    set: function(obj, prop, value) {
        console.log('设置 set 操作')
        obj[prop] = value;
    },
    // 使用 has 方法隐藏某些属性，不被 in 运算符发现
    has (target, key) {
        if (key[0] === '_') {
          return false;
        }
        return key in target;
    }
});

proxy.time = 35; // 设置 set 操作
console.log(proxy.time); // 设置 get 操作 // 35
console.log('_prop' in proxy); // false
```
