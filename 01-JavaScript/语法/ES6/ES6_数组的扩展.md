# ES6_数组的扩展

## 参考文档
- [数组的扩展](http://es6.ruanyifeng.com/#docs/array)

- Array.prototype.flat();  用于将嵌套的数组“拉平”，变成一维的数组。
- Array.prototype.flatMap();  相当于 map + flat(1)，只能展开一层数组。

## arr.flat(depth)
- depth 表示想要拉平的层数，默认为1。
```js
var arr3 = [1, 2, [3, 4, [5, 6]]];
arr3.flat();  // [1, 2, 3, 4, [5, 6]]

//使用 Infinity 作为深度，展开任意深度的嵌套数组
arr3.flat(Infinity);  // [1, 2, 3, 4, 5, 6]
```

- flat() 方法会移除数组中的空项
```js
var arr4 = [1, 2, , 4, 5];
arr4.flat();  // [1, 2, 4, 5]
```

## flatMap()
```
arr.flatMap(function callback(currentValue[, index[, array]]) {
    // 返回新数组的元素
}[, thisArg])
```
```js
[2, 3, 4].flatMap((x) => [x, x * 2]);   // [2, 4, 3, 6, 4, 8]
// 相当于 [[2, 4], [3, 6], [4, 8]].flat()
```
