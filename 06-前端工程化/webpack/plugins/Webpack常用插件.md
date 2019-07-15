# Plugins

- HotModuleReplacementPlugin 常用于开发环境，启用模块热替换
- HtmlWebpackPlugin，会在打包结束后，自动生成一个 html 文件，并把打包生成的 js 自动引入到这个 html 文件中。
  - template，html模板文件的路径
- CleanWebpackPlugin 用于删除/清理构建文件夹
- webpack.ProvidePlugin 自动引用对应的模块
```js
new webpack.ProvidePlugin({
  $: 'jquery',  // 如果页面使用了 $，webpack 会自动添加 import $ from 'jquery';
});
```
- webpack.DefinePlugin 配置全局常量

## Hot Module Replacement
永远不要在生产环境(production)下启用 HMR
```js
module.exports = {
  devServer: {
    hot: true
  },
  plugins: [
    new webpack.HotModuleReplacementPlugin({
      // Options...
    })
  ]
};
```

## 将 CSS 提取至一个独立的 CSS 文件中
webpack 提供了专门的插件，用于将CSS代码进行分割，提取到独立的css文件中。
- 在 webpack 1，2，3 中，使用 ExtractTextWebpackPlugin
- 在 webpack 4 中，使用 MiniCssExtractPlugin
