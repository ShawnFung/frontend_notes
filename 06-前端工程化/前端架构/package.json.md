# package.json

## 运行 npm run xxx 的时候发生了什么？
1. 运行 npm run xxx的时候，npm 会先在当前目录的 node_modules/.bin 查找要执行的程序，如果找到则运行；
2. 没有找到则从全局的 node_modules/.bin 中查找，npm i -g xxx就是安装到到全局目录；
3. 如果全局目录还是没找到，那么就从 path 环境变量中查找有没有其他同名的可执行程序。

node_modules/.bin 中有三个 vue-cli-service 文件，为什么会有三个文件呢？
```
# unix 系默认的可执行文件，必须输入完整文件名
vue-cli-service

# windows cmd 中默认的可执行文件，当我们不添加后缀名时，自动根据 pathext 查找文件
vue-cli-service.cmd

# Windows PowerShell 中可执行文件，可以跨平台
vue-cli-service.ps1
```
当我们运行 vue-cli-service serve 这条命令的时候，就相当于运行 node_modules/.bin/vue-cli-service.cmd serve。

## 自定义命令 bin
node_modules/.bin 目录，这个目录不是任何一个 npm 包。目录下的文件，表示这是一个个软链接。这些软链接来源于 package.json 中的 bin 配置，当执行 npm install 安装依赖时，npm 读到该配置后，就将该文件软链接到 ./node_modules/.bin 目录下。如果是全局安装，则将文件软链接到全局的 ./node_modules/.bin 目录下。
```
"bin": {
  "my-app-cli": "./bin/cli.js"
}
```
若要实现像 vue create 之类的命令一样简便的方式，则可以在可执行文件 cli.js 中的第一行写入以下命令：
```
#!/usr/bin/env node
```

## 参考文档
- [三面面试官：运行 npm run xxx 的时候发生了什么？](https://cloud.tencent.com/developer/article/1963791)