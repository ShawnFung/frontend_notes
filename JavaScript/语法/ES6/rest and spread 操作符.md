## rest and spread 运算符


### rest 运算符 ...
一般用在函数参数的声明中，用于获取函数调用时传入的参数。  
rest 单词的意思就是剩余的，把剩余的都归集到一起
```
function testFunc(...args) {
   console.log(args);  // ['aa', 'bb', 'cc']
   console.log(args.length); // 3
}
 // 调用函数
 testFunc('aa', 'bb', 'cc');
```

### spread 展开运算符 ...
主要用于函数调用。
```
let arrs1 = ['aa', 'bb'];
let arrs2 = ['cc', 'dd'];

// 展开运算符可以展开数组
var parts = ['shoulders', 'knees'];
var lyrics = ['head', ...parts, 'and', 'toes'];
// ["head", "shoulders", "knees", "and", "toes"]

// 替换 concat 方法
var arr1 = [0, 1, 2], arr2 = [3, 4, 5];
arr1.push(...arr2);
arr1 // [0, 1, 2, 3, 4, 5]

// 析构数组
let param1, param2;
[param1, ...param2] = arrs1;

console.log(param1); // aa
console.log(param2); // ['bb']
```

### 析构表达式
对象解构
```
var o = {
    a: 1,
    b: {
        price: 1
    }
};
var {a, b} = o;
console.log(b);  // { price: 1}
```

解构数组
```
var arr = ['aa', 'bb', 'cc'];
let [a1, a2, a3] = arr;
console.log(a1); // aa
console.log(a2); // bb
console.log(a3); // cc
```

### 参考文档
- [理解spread运算符与rest参数](https://www.cnblogs.com/tugenhua0707/p/7476625.html)