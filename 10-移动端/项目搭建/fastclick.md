# fastclick

## 为什么要使用fastclick
在部分手机上，click事件存在300毫秒的延迟。

## fastclick的原理
fastclick的思路就是利用touch来模拟tap（触碰），如果认为是一次有效的tap，则在touchend时立即模拟一个click事件，分发到事件源（相当于主动触发一次click），同时阻止掉浏览器300ms后产生的click。

## 安装 fastclick
在页面直接引入fastclick.js
```html
<script type='application/javascript' src='/path/to/fastclick.js'></script>
```
或者使用npm安装
```
npm install fastclick
```

## 初始化FastClick实例
纯Javascript版
```js
if ('addEventListener' in document) {
    document.addEventListener('DOMContentLoaded', function() {
        FastClick.attach(document.body);
    }, false);
}
```
jQuery版
```js
$(function() {
    FastClick.attach(document.body);
});
```
类似Common JS的模块系统方式
```js
var attachFastClick = require('fastclick');
attachFastClick.attach(document.body);
```

## 使用needsclick过滤特定的元素
如果页面上有一些特定的元素不需要使用fastclick来立刻触发点击事件，可以在元素的class上添加needsclick:
```html
<a class="needsclick">Ignored by FastClick</a>
```

## 不需要使用fastclick的情况
以下这几种情况是不需要使用fastclick：
1. FastClick是不会对PC浏览器添加监听事件
2. Android版Chrome 32+浏览器，如果设置viewport meta的值为width=device-width，这种情况下浏览器会马上出发点击事件，不会延迟300毫秒。
```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```
3. 所有版本的Android Chrome浏览器，如果设置viewport meta的值有user-scalable=no，浏览器也是会马上出发点击事件。
4. IE11+浏览器设置了css的属性touch-action: manipulation，它会在某些标签（a，button等）禁止双击事件，IE10的为-ms-touch-action: manipulation

## 参考文档
- [FastClick用法](https://www.jianshu.com/p/150c305f6930)
