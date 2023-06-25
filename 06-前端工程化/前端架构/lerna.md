# lerna 多包管理工具
Lerna 是一个优化基于 git + npm 的多 package 的项目管理工具。

## 多 package 项目存在什么问题
- 重复操作
  - 多 Packages 本地 Link
  - 多 Packages 依赖安装
  - 多 Packages 单元测试
  - 多 Packages 代码提交
  - 多 Packages 代码发布
- 版本一致性
  - 发布时版本一致型
  - 发布后相互依赖版本升级

multiRepo 工具应该至少具备以下两大能力：
- 依赖管理：可管理所有 package 的依赖和彼此之间的关联，并将安装的依赖提升到顶层 node_modules
- 更精准的执行和发布控制：能够进行独立或统一的测试、构建和精准发布等

在 Node 生态中，主要有：
- NPM/Yarn 两种包管理器，两者都可以通过开启 Workspace 特性来支持能力 1 并对能力 2 提供部分支持。Yarn 无法直接做到 lerna publish/lerna.json 的更精准控制能力。
- Lerna 等工具对能力 2 的支持较好。

总的方案有以下几种：
- Lerna
- Lerna + NPM/Yarn Workspace

## lerna 开发流程
- 脚手架项目初始化
  - 初始化 npm 项目
  - 安装 lerna
  - lerna init 初始化项目
- 创建 package
  - lerna create 创建 package
  - lerna add 安装依赖，但是 Lerna 的 add 命令每次只能安装一个依赖，不能像 npm install 和 yarn add 一次可装多个依赖。
  - lerna link 链接依赖
- 脚手架开发和测试
  - lerna exec 执行 shell 脚本
  - lerna run 执行 npm 命令
  - lerna clean 清空依赖
  - lerna bootstrap 重装依赖
- 脚手架发布上线
  - lerna version 提升版本号
  - lerna changed 查看上版本依赖的所有变更
  - lerna diff 查看 diff
  - lerna publish 项目发布

Lerna 并未提供移除依赖相关的指令，只能手动编辑该包的 package.json，手动移除对应的依赖项，最后再运行lerna bootstrap指令更新依赖。

## lerna 与 workspaces
更改 lerna.json 开启 workspaces：
```
{
  "useWorkspaces": "true",
  "npmClient": "yarn",  // 如果使用 yarn，需要配置 npmClient
}
```
然后在根目录的 package.json 中配置 workspaces，此时 lerna.json 中的 packages 设置会失效。
```
{
  "name": "root",
  "workspaces": [
    "packages/*"
  ],
}
```
这样的话，依赖管理就全部交给 npm/yarn 了

## 其他 MultiRepo 方案
- pnpm

## 源码分析

## 参考文档
- [Lerna 运行流程剖析](http://zoo.zhengcaiyun.cn/blog/article/lerna-js)
- [【架构师（第三篇）】脚手架开发之掌握Lerna操作流程](https://blog.51cto.com/u_15344825/5195952)
- [大仓实践录：Lerna/NPM/Yarn Workspace 方案组合和性能对比](https://cloud.tencent.com/developer/article/1913720)