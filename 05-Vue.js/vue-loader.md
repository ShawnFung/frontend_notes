# vue-loader

## 处理资源路径
```html
<template>
  <!--相对路径-->
  <img class="logo" src="assets/logo.png">
  <img class="logo" src="./assets/logo.png">
  
  <!--模块依赖，在 webpack alias 中配置了 assets  -->
  <img class="logo" src="~assets/logo.png">
</template>

<!--当不存在 alias 配置的时候，就会去 node_modules 中拿-->
<style>
  @import "~element-ui/packages/theme-chalk/src/index.scss";
</style>
```
