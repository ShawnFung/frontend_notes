## PostCSS  

通过Vue-cli构建的项目，在项目的根目录下有一个.postcssrc.js，默认情况下已经有了：
```
module.exports = { 
    "plugins": { 
        "postcss-import": {}, 
        "postcss-url": {}, 
        "autoprefixer": {} 
    } 
}
```

### PostCSS 插件

| 插件名 | 作用 | 备注 |
| ----- | ---- | ---- |
| [autoprefixer](https://github.com/postcss/autoprefixer) | 用来自动处理浏览器前缀 | 在配置的时候，未显示配置相关参数的话，表示使用的是 [Browserslist](https://github.com/ai/browserslist) 指定的列表参数，你也可以像这样来指定last 2 versions 或者 > 5%。|
| [postcss-import](https://github.com/postcss/postcss-import) | 解决@import引入路径问题。使用这个插件，可以让你很轻易的使用本地文件、node_modules或者web_modules的文件。|
| [postcss-url](https://github.com/postcss/postcss-url) | 处理文件，比如图片文件、字体文件等引用路径的处理 | 
| [postcss-cssnext](https://cssnext.io/) | 可以让我们使用CSS未来的特性，其会对这些特性做相关的兼容性处理。|
| [cssnano](https://cssnano.co/guides/getting-started/) | 压缩和清理CSS代码 | 在Webpack中，cssnano和css-loader捆绑在一起，所以不需要自己加载它。不过你也可以使用postcss-loader显式的使用cssnano |
| postcss-px-to-viewport | 用来把px单位转换为vw、vh、vmin或者vmax这样的视窗单位 | 

参考文档：
1. [如何在Vue项目中使用vw实现移动端适配](https://www.w3cplus.com/mobile/vw-layout-in-vue.html)
2. 
