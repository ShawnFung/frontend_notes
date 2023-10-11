# React 项目实战

## 1.后台系统多 Tab 页缓存功能实现（keep-alive）

### 1.1 方案一
在 Layout 组件中，使用一个状态变量，管理所有打开的页面组件（这个状态可以是组件内部状态，可以是全局状态，可以是全局持久化状态，根据需求来定）  
监听 pathname，当 pathname 变化时，判断当前地址是否在已打开的页签中，是，则激活这个 tab 页签；否，则新增一个 tab 页签（新增过程中，可能需要判断用户是否有当前页面的权限）   
这种方案会使用 Tabs 组件来渲染多个页面组件，不知是否对性能有影响？  
案例：[react-antd-multi-tabs-admin](https://github.com/hsl947/react-antd-multi-tabs-admin)

### 参考文档
- [React 中后台系统多 Tab 页缓存功能实现（keep-alive）](https://toutiao.io/posts/y0wdd3m/preview)