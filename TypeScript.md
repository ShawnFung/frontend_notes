# TypeScript

## 概述
[TypeScript 快速入门](https://www.w3cschool.cn/typescript/typescript-tutorial.html)


## 类型声明文件 d.ts
如果要在ts文件里引入第三方的js库（比如Jquery或者自己写的js模块），那么该js没有类型约束，怎么办？这时候就可以引入该文件的.d.ts，然后typescript就会根据这个类型申明文件对该js进行类型验证。

## 两种类别
- 全局类型声明(Global Type Definition)
- 模块导出声明(External Module Definition)  

模块库至少会包含下列具有代表性的条目之一：
  - 无条件的调用require或define
  - 像import * as a from 'b'; or export c;这样的声明
  - 赋值给exports或module.exports   

它们极少包含：
  - 对window或global的赋值

```
declare interface funcAbcSign {
    (s: string): string
}

export declare let abc: funcAbcSign;
```

### 全局变量
```
declare var foo: number;
```

### 全局函数
```
declare function greet(greeting: string): void;
```

### 带属性的对象
使用declare namespace描述用点表示法访问的类型或值。
```
declare namespace myLib {
    function makeGreeting(s: string): string;
    let numberOfGreetings: number;
}
```

### 函数重载
```
declare function getWidget(n: number): Widget;
declare function getWidget(s: string): Widget[];
```

### 类
```
declare class Greeter {
    constructor(greeting: string);

    greeting: string;
    showGreeting(): void;
}
```

## 参考文档
- 