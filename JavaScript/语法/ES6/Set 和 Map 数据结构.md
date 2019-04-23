# Set 和 Map 数据结构

## Set
- 类似于数组，但是成员的值都是唯一的，没有重复的值。
```js
// 数组去重
[...new Set([1, 1, 2, 3])];   // [1, 2, 3]
// 数组去重
function dedupe(array) {
  return Array.from(new Set(array));
}
dedupe([1, 1, 2, 3]);  // [1, 2, 3]
// 字符串去重
[...new Set('ababbc')].join('');   // abc
```
- 向 Set 加入值的时候，不会发生类型转换，所以5和"5"是两个不同的值。
- Set结构转为数组
```js
const items = new Set([1, 2, 3, 4, 5]);
const array = Array.from(items);
```
- Set 结构的键名就是键值，所以keys方法和values方法的行为完全一致。
- 使用 Set 可以很容易地实现并集（Union）、交集（Intersect）和差集（Difference）。
```js
let a = new Set([1, 2, 3]);
let b = new Set([4, 3, 2]);

// 并集
let union = new Set([...a, ...b]);  // Set {1, 2, 3, 4}

// 交集
let intersect = new Set([...a].filter(x => b.has(x)));  // set {2, 3}

// 差集
let difference = new Set([...a].filter(x => !b.has(x)));  // Set {1}
```

## WeakSet
WeakSet 结构与 Set 类似，也是不重复的值的集合。但是，它与 Set 有两个区别。
- WeakSet 的成员只能是对象，而不能是其他类型的值。
- WeakSet 中的对象都是弱引用，即垃圾回收机制不考虑 WeakSet 对该对象的引用
  - 储存 DOM 节点，而不用担心这些节点从文档移除时，会引发内存泄漏
- WeakSet 不能遍历

## Map
- Map 与 Object 的区别
  - Object 只能使用字符串当作键
  - Map 可以使用各种类型的值（包括对象）当作键
- Map 的键实际上是跟内存地址绑定的，只要内存地址不一样，就视为两个键。
```js
const map = new Map();

const k1 = ['a'];
const k2 = ['a'];

map.set(k1, 111)
   .set(k2, 222);

map.get(k1) // 111
map.get(k2) // 222
```
- Map 的遍历顺序就是插入顺序

## WeakMap
WeakMap结构与Map结构类似，也是用于生成键值对的集合。WeakMap与Map的区别有两点。
- WeakMap 只接受对象作为键名，不接受其他类型的值作为键名。
- WeakMap 的键名所引用的对象是弱引用，一个对象若只被弱引用所引用，则被认为是不可访问（或弱可访问）的，并因此可能在任何时刻被回收。所以 WeakMap 可以帮你省掉手动删除对象关联数据的步骤，当你不能或者不想控制关联数据的生命周期时就可以考虑使用 WeakMap。

### 应用
- 在 DOM 对象上保存相关数据
```js
let wm = new WeakMap();
var element = document.querySelector(".element");
wm.set(element, "data");
```
- 数据缓存

## 参考文档
- [ES6 系列之 WeakMap](https://github.com/mqyqingfeng/Blog/issues/92)

