# 写 React / Vue 项目时为什么要在组件中写 key，其作用是什么？

## 就地复用策略，不使用 key 时的默认的模式。
只适用于不依赖子组件状态或临时 DOM 状态 (例如：表单输入值) 的列表渲染输出。
```html
<div v-for="item in items">
  <!-- 内容 -->
</div>
```

## 使用 key
说到底，key的作用就是更新组件时判断两个节点是否相同。相同就复用，不相同就删除旧的创建新的。
```html
<div v-for="item in items" :key="item.id">
  <!-- 内容 -->
</div>
```

