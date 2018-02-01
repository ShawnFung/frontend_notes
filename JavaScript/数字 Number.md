## Number  

二进制浮点数最大的问题（不仅 JavaScript，所有遵循 IEEE 754 规范的语言都是如此），是会出现如下情况：
```
0.1 + 0.2 === 0.3; // false
```
最常见的方法是设置一个误差范围值，通常称为“机器精度”（machine epsilon），从 ES6 开始，该值定义在 Number.EPSILON 中。
```
function numbersCloseEnoughToEqual(n1,n2) {
 return Math.abs( n1 - n2 ) < Number.EPSILON;
}
var a = 0.1 + 0.2;
var b = 0.3;
numbersCloseEnoughToEqual( a, b );
```

| 方法、属性 | 描述 | 参数 | 返回值 |
| ---- | ---- | --- | ---- |
| toFixed(digits) | 设置小数点位数 | 小数点个数 | 字符串
| toExponential(fractionDigits) | 以指数表示法显示 | fractionDigits | 字符串 |
| toPrecision(precision) | 以指定的精度返回该数值 | | 字符串
| isInteger(value) | 一个值是否是整数 | 值 | boolean |
| isSafeInteger(value) | 一个值是否是安全的整数 | 值 | boolean |
| MAX_SAFE_INTEGER | 最大的整数 |
| MIN_SAFE_INTEGER | 最小的整数 |
| MAX_VALUE | 最大浮点数 | 
| MIN_VALUE | 最小浮点数 | 
| EPSILON | 机器精度，这个值通常是 2^-52 (2.220446049250313e-16) |