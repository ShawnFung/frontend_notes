# ElementUI 源码

- provide/inject 依赖注入
- Vue.extend()


## Vue.extend()
```javascript
import Loading from './loading.vue';
let Mask = Vue.extend(Loading);
// 创建 Loading 实例，并挂载到一个元素上。
const mask = new Mask().$mount('#mount-point')
```

## directive 指令
给指令传参的方式：
- arg，例如：v-my-directive:foo
- modifiers，例如：v-my-directive.foo.bar
- DOM 属性，例如：element-loading-text="拼命加载中"
```html
<el-button
  v-loading.fullscreen.lock="isLoading"
  element-loading-text="拼命加载中"
>
</el-button>
```
