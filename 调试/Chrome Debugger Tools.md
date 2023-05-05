# Chrome Debugger Tools

## Console
- console.log
console 中打印出的对象，在你打印出他内容之前，是以引用的方式保存的。所以可能存在修改前的打印和修改后的打印，是一样的情况。
- console.dir：打印 Element 的具体属性
- 使用实时表达式：点击[眼睛]图标，然后输入表达式
- 监测执行时间：console.time() 和 console.timeEnd()

## 断点
- 普通断点：运行到该处就断住
- 条件断点：运行到该处且表达式为真就断住，比普通断点更灵活
- DOM 断点：DOM 的子树变动、属性变动、节点删除时断住，可以用来调试引起 DOM 变化的代码
- URL 断点：URL 匹配某个模式的时候断住，可以用来调试请求相关代码
- Event Listener 断点：触发某个事件监听器的时候断住，可以用来调试事件相关代码
- 异常断点：抛出异常被捕获或者未被捕获的时候断住，可以用来调试发生异常的代码
- Logpoints：避免了在代码中添加 console.log，提高了代码整洁性，线上的网站也可以直接添加控制台输出。

## Sources
- 添加 sourcemap：在左侧列表中，选中需要添加 sourcemap 的文件，然后在右侧编辑器中，右键选择 Add source map
- 添加代码块 Snippets：Sources-Snippets 可以存放 JavaScript 代码到 DevTools 中，方便你复用这些 JavaScript 代码块。

## Network
- 一键重新发送请求：选中需要重新发送的请求，右键选择Replay XHR。
- 在控制台快速发起请求，可以修改入参：选中需要发送的请求，右键选择Copy as fetch，控制台粘贴代码，修改参数，回车搞定。


## 参考文档
- [JS 的 6 种打断点的方式，你用过几种？](https://juejin.cn/post/7041946855592165389)