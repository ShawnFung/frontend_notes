## Object 对象

### 创建 Object 对象
1. 使用 new 操作符 + Object 构造函数
```
var person = new Object();
person.name = 'Nicholas'
```
2. 使用对象字面量
```
var person = {
    name: 'Nicholas'
}
```

### 访问对象属性
```
var myObject = {
    a: 2
}
myObject.a;  // .操作符
myObject['a'];  // []操作符
```

### 可计算属性名 ES6
ES6 增加了可计算属性名，可以在文字形式中使用[]包裹一个表达式来当作属性名。
```
var prefix = 'foo'
var myObject = {
    [prefix + 'bar']: 'hello'
}
```

### 属性与方法
获取对象属性名的方法（都只检查对象，不会检查原型链）
| 方法 | 参数 | 返回值 |
| ---- | -- | ------- |
| keys( obj ) | 对象 | 所有可枚举属性的字符串数组 |
| getOwnPropertyNames( obj ) | 对象 | 所有的属性名（包括不可枚举属性但不包括Symbol值作为名称的属性）组成的数组 |
| getOwnPropertySymbols( obj ) | 对象 | 所有 Symbol 属性的数组 |

判断对象中是否存在某个属性
| 方式 | 检查范围 |
| ---- | --------|
| for .. in | 对象及其[[Prototype]]原型链 | 
| hasOwnProperty | 只检查对象，不会检查[[Prototype]]原型链 |

| 方法 | 返回值 | 作用 |
| ---- | ----- | ---- |
| defineProperty(obj, prop, descriptor) | 被传递给函数的对象 obj | 在一个对象上定义一个新属性，或者修改一个对象的现有属性 |
| assign(target, ...sources) | 目标对象 target | 将所有可枚举属性的值从一个或多个源对象复制到目标对象 |
