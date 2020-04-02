# require 动态加载

## require context
```javascript
require.context(directory, useSubdirectories = false, regExp = /^\.\//);
```
可以给这个函数传入三个参数：
1. 要搜索的目录，
2. 是否还搜索其子目录， 
3. 匹配文件的正则表达式。

### 示例一
```javascript
/** 
* 根据不同的语言，获取对应的 json 文件，json 文件命名为：rules_zh.json、rules_en.json
* @param language，取值可以是 zh、en
*/
function getJsonByLanguage(language) {
  let contexts = require.context('.', false, /\.json/)
  contexts.keys().forEach(key => {
    if(key.indexOf(language) >= 0){
      let file = contexts(key)
      callback(file)
    }
  })
}
```

### 示例二
将 components 文件夹下的所有以 .vue 结尾的文件，进行全局注册
```javascript
import Vue from 'vue'
let contexts = require.context('.', false, /\.vue$/)
contexts.keys().forEach(component => {
  // debugger;
  let componentEntity = contexts(component).default
  // 使用内置的组件名称 进行全局组件注册
  Vue.component(componentEntity.name, componentEntity)
})
```

## 参考文档
1. [webpack 再使用变量作为 require 路径时，打包 Critical dependencies 警告](https://blog.gaoqixhb.com/p/581ab5b9f143f9631c26d039)
2. [webpack require context 说明](https://www.jianshu.com/p/78f7b19932cb)
3. [require.context](https://webpack.js.org/guides/dependency-management/#require-context)
4. [动态传值给require加载vue组件？](https://segmentfault.com/q/1010000008977653)
