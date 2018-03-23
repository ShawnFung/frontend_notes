## TypeScript

### 概述
[TypeScript 快速入门](https://www.w3cschool.cn/typescript/typescript-tutorial.html)


### 类型声明文件 d.ts
如果要在ts文件里引入第三方的js库（比如Jquery或者自己写的js模块），那么该js没有类型约束，怎么办？这时候就可以引入该文件的.d.ts，然后typescript就会根据这个类型申明文件对该js进行类型验证。