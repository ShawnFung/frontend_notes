## ES6
Q: ES6有哪些新特性？
* 可计算属性名
* Symbol


ES6 新增 API：
* Number.isNaN(); 判断一个值是不是NaN。
* Object.is(); 判断两个值是否绝对相等。Object.is()类似于===，但在三等号判等的基础上特别处理了 NaN 、-0 和 +0 ，保证 -0 和 +0 不再相同，但 Object.is(NaN, NaN) 会返回 true。
```
0 === - 0;  // true
Object.is(0, -0);  // false
NaN === NaN;  // false
Object.is(NaN, NaN);  // true
```