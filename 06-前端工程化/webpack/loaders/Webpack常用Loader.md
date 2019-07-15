# [Loader](https://webpack.js.org/loaders/)

- webpack只支持js/json类型的文件，对于其他webpack不支持的文件类型（如css/ts/image/less等），需要通过loader转换成有效的模块。
- loader的执行的顺序是：从下到上，从右到左。
```js
import avatar from './avatar.png';  // 引入图片，avatar的值是图片的路径
import './index.css';   // 引入css文件
```

## Files
- file-loader，可以解析项目中的url引入（不仅限于css），根据我们的配置，将图片拷贝到相应的路径，并修改打包后文件引用路径，使之指向正确的文件。常用于图片、字体等文件的打包。
- url-loader，提供了一个limit参数，小于limit字节的文件会被转为DataURl，大于limit的还是会使用file-loader进行copy。
    - url-loader内置了file-loader，因此使用url-loader时，只需要安装url-loader即可，不需要安装file-loader。

## Styling
- style-loader 通过添加```<style>```标签，将 CSS 内容挂载到页面上，
- css-loader
  - importLoaders
  - modules 是否启用 CSS Modules。
- sass-loader 加载 sass/scss 文件，并将其解析成 CSS。
- less-loader 加载 less 文件，并将其解析成 CSS。
- postcss-loader 让webpack能够使用 PostCSS 去处理 CSS

## 使用Babel处理ES6语法
[安装](https://babeljs.io/setup#installation)
```
npm install --save-dev babel-loader @babel/core @babel/preset-env
```
使用：
```js
module: {
  rules: [
    {
      test: /\.js$/,
      exclude: /node_modules/,
      use: {
        loader: 'babel-loader',
        options: {
          presets: [['@babel/preset-env', {
            useBuiltIns: 'usage'  
          }]]
        }
      }
    }
  ]
}
```

## 其他
- imports-loader？
