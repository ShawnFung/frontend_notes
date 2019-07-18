## package.json

描述：在Node项目中用于描述项目的一些基本信息，以及依赖的配置。

在项目的根目录中我们可以通过npm init来初始化一个package.json文件，其内容是一个Json对象，基本结构如下：
```
{
  "name": "element-ui",
  "version": "2.0.11",
  "description": "",
  "main": "lib/element-ui.common.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "author": "",
  "license": "ISC"
}
```

### name 属性和main属性
name和version属性是package.json文件两个不可或缺的属性，通常name属性和我们项目的文件名称是一样的。  
version表示这个项目的版本号。
main属性指定了加载时的入口文件，当使用require()语法来加载一个模块时，就会查看package.json文件的main属性。默认就会加载模块中的index.js文件。

### scripts属性

### dependencies devDependencies属性

### 参考文档
1. [初学Node（二）package.json文件](https://www.cnblogs.com/shinhwazt/p/6052753.html)
2. [package.json](https://segmentfault.com/a/1190000008941050)