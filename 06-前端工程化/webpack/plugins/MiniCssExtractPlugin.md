# [MiniCssExtractPlugin](https://webpack.js.org/plugins/mini-css-extract-plugin/)
CSS代码分割插件，不支持 HMR，所以不能在开发环境使用。

## 使用：
```js
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  plugins: [
    // 1. 添加 plugin
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[id].css',
    }),
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        // 2. 添加 loader
        use: [MiniCssExtractPlugin.loader, 'css-loader'],   
      },
    ],
  },
};
```

## OptimizeCSSAssetsPlugin，CSS代码压缩合并插件
```js
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
module.exports = {
  optimization: {
    minimizer: [new OptimizeCSSAssetsPlugin({})],
  }
};
```

## 将所有CSS提取到单个文件中
```js
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  optimization: {
    splitChunks: {
      cacheGroups: {
        styles: {
          name: 'styles',
          test: /\.css$/,
          chunks: 'all',
          enforce: true,
        },
      },
    },
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
    }),
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader'],
      },
    ],
  },
};
```
