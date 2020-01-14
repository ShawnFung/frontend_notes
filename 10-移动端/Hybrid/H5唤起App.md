# H5唤起APP

- URL Scheme
- Universal Link

## 在网页中调用「URL Scheme」
- 方案一：链接跳转
```html
<a href="ibeiliao://">打开贝聊</a>
```
- 方案二：JS跳转
```html
<a href="javascript:location.href='ibeiliao://'">打开贝聊</a>
```
- 方案三：iframe调用
```js
document.getElementById('open-ibeiliao').onclick = function() {
   var iframe = document.createElement('iframe');
   iframe.src = 'ibeiliao://';
   iframe.style.display = 'none';
   document.body.appendChild(iframe);
   setTimeout(function(){
       document.body.removeChild(iframe);
   }, 3000);
};
```

## Universal Link
Universal Link 是苹果在 WWDC2015 上为 iOS9 引入的新功能，通过传统的 HTTP 链接即可打开 APP。如果用户未安装 APP，则会跳转到该链接所对应的页面。

## 参考文档
- [H5唤起APP指南(附开源唤端库)](https://juejin.im/post/5b7efb2ee51d45388b6af96c#heading-9)
