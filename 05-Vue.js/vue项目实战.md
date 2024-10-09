# Vue项目实战

- vite
  - 插件
  - 目录结构
    - api，接口文件夹
    - assets，静态资源，如图片、图标、样式等。
    - components，组件
    - directive，指令
    - lang，国际化
    - layout
    - plugins
    - router，路由文件
    - store
    - types，ts 文件
    - utils，工具文件
      - auth，管理 token 的增删改查
      - dict，管理数据字典
      - helper，工具方法
      - permission，权限
      - requests，请求
      - validate，校验
    - views，页面文件
  - 第三方库
    - pinia，状态管理


## 1.后台系统多 Tab 页缓存功能实现（keep-alive）
```vue
<template>
  <router-view v-slot="{ Component }">
    <keep-alive :include="caches">
      <component :is="Component" />
    </keep-alive>
  </router-view>
</template>
```