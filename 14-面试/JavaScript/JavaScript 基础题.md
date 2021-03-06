# JavaScript 基础题

## call 和 apply 的区别是什么？
区别在于传入参数的不同
- 第一个参数都是，指定函数体内this的指向；
- call  从第二个开始传入的参数是不固定的，都会传给函数作为参数。
```js
// 尤其是 es6 引入了 Spread operator (延展操作符) 后，即使参数是数组，可以使用 call
let params = [1,2,3,4]
xx.call(obj, ...params)
```
- apply 第二个参数是传入带下标的集合，数组或者类数组

## 使用 sort() 对数组 [3, 15, 8, 29, 102, 22] 进行排序，输出结果
```js
[3, 15, 8, 29, 102, 22].sort();
// 结果：[102, 15, 22, 29, 3, 8]
```
根据MDN上对Array.sort()的解释，默认的排序方法会将数组元素转换为字符串，然后比较字符串中字符的UTF-16编码顺序来进行排序。所以'102' 会排在 '15' 前面。

## ['1', '2', '3'].map(parseInt) what & why ?
```
结果是：[1, NaN, NaN]
```
分析：
- map(function(value, index){ ... });  map的回调函数会传入 2 个参数，分别是数组某一项的值和索引
- parseInt(string, radix);  parseInt可传入 2 个参数，分别是 string 代表要被解析的值，radix 表示上述字符串的基数（进制），默认为 10 进制。  
```js
['1', '2', '3'].map(parseInt);
// 相当于
parseInt('1', 0);   // 1
parseInt('2', 1);   // NaN 基数为2（1进制）
parseInt('3', 2);   // NaN 基数为2（2进制），'3'在2进制中是一个非法的值，2进制中只能存在0和1，所以无法解析，返回NaN
```
请问以下代码返回的结果是什么？
```js
['10','10','10','10','10'].map(parseInt);
```


