# 为什么在 Vue3.0 采用了 Proxy

## 参考文档
- [Vue3.0 尝鲜，Object.defineProperty VS Proxy](http://www.10tiao.com/html/780/201812/2650588659/1.html)

## 为什么要取代Object.defineProperty？
- Object.defineProperty无法监控到数组下标的变化，导致直接通过数组的下标给数组设置值，不能实时响应。 为了解决这个问题，经过vue内部处理后可以使用以下几种方法来监听数组。
```js
push()
pop()
shift()
unshift()
splice()
sort()
reverse()
```
- Object.defineProperty只能劫持对象的属性，从而需要对每个对象，每个属性进行遍历，Vue 2.x里，是通过 递归 + 遍历 data 对象来实现对数据的监控的，如果，属性值是对象，还需要深度遍历。Proxy可以劫持整个对象，并返回一个新的对象。
- Proxy不仅可以代理对象，还可以代理数组。还可以代理动态增加的属性。
