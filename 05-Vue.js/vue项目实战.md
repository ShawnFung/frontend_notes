# Vue项目实战

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