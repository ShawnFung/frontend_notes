# 常用 npm 命令

## npm init
如果执行的是 npm init xxx，则 npm 会去找 create-xxx 包来执行项目初始化。

## npm install 安装依赖
1. 如果安装过程出现sass相关的安装错误，请在安装mirror-config-china后重试。
```
$ npm install -g mirror-config-china
```

## npx
npm 从5.2版开始，增加了 npx 命令。

- 运行项目本地安装的可执行工具
```
npm i -D webpack
npx webpack ...
```
- 无需安装，执行一次性命令  
npx命令找包顺序：先自动查找当前依赖包中的可执行文件，如果找不到，就会去 PATH 里找。如果依然找不到，就会帮你临时安装，执行完后再删除包。
```
npx create-react-app my-cool-new-app
```
- 指定一个 node 版本去执行 node 命令
```
npx -p node@8 npm run build
```
