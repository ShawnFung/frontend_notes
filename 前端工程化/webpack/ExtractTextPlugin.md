## ExtractTextPlugin ##

用途：抽离 CSS 样式

```
const ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
    module: {
        rules: [{
            test: /\.css$/,
            use: ExtractTextPlugin.extract({
                fallback: "style-loader", // 编译后用什么loader来提取css文件
                use: "css-loader" // 指需要什么样的loader去编译文件,这里由于源文件是.css所以选择css-loader
            })
        }]
    },
    plugins: [
        new ExtractTextPlugin("styles.css"),
    ]
}
```

Q：webpack 如何提取 vue 组件的 css 到独立文件中，而不是以 style 的形式嵌在 html 中？
[vue-loader 官方手册，使用 extractCSS 选项](https://vue-loader.vuejs.org/zh-cn/options.html#extractcss)
```
// webpack.config.js 
var ExtractTextPlugin = require("extract-text-webpack-plugin") 
module.exports = { 
    // other options... 
    module: { 
        rules: [ { 
            test: /\.vue$/, 
            loader: 'vue-loader', 
            options: { 
                extractCSS: true 
            } 
        } ] 
    }, 
    plugins: [
        new ExtractTextPlugin("style.css") 
    ] 
}
```

参考文档：
1. [官网使用说明](https://github.com/webpack-contrib/extract-text-webpack-plugin)

