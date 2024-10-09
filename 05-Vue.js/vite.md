# vite 前端构建工具

- 指定软链接：resolve.alias
- 代理服务器配置：server.proxy
- 环境变量：只有以 VITE_ 为前缀的变量才会暴露给经过 vite 处理的代码
- [Glob 导入](https://cn.vitejs.dev/guide/features.html#glob-import)
- 插件
  - [vite-plugin-svg-icons](https://github.com/vbenjs/vite-plugin-svg-icons/blob/main/README.zh_CN.md) 用于生成 svg 雪碧图
  - unplugin-icons/vite，自动安装图标库
  - 组件自动注册
    - [defineAsyncComponent](https://cn.vuejs.org/guide/components/async.html)
    - unplugin-auto-import/vite，自动导入
    - unplugin-vue-components/vite，自动注册组件
  - vite-plugin-compression，压缩插件
  - vite-plugin-vue-setup-extend？
  - unocss/vite？
  - vite-plugin-monaco-editor？