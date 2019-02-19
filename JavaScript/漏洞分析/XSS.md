# XSS Cross Site Scripting 跨站脚本攻击

## 危害
- 获取页面数据
- 获取 Cookies
- 劫持前端逻辑
- 发送请求
- ...

## 攻击类型
- 反射型，URL参数直接注入。  
例如：
```
https://www.zcool.com.cn/search/content?&word=<script>alert(1)</script>
```
通过会伪装成短网址进行传播。
- 存储型，XSS代码存储到数据库后读取时注入。

## XSS攻击注入点
- HTML节点内容。
```html
<div>
  #{content}
</div>
<!--节点内容是用户输入的，可能被注入脚本。例如：-->
<div>
  <script></script>
</div>
```
- HTML属性。
```html
<img src="#{image}" />
<img src="1" onerror="alert(1)" />  // 用户输入的数据是：1" onerror="alert(1)
```
- JavaScript代码。
```html
<script>
  var data = "#{data}"
  var data = "hello";alert(1);"";   // 用户输入的数据是：hello";alert(1);"
</script>
```

## XSS攻击防御
- 浏览器自带防御，参数出现在HTML内容或属性中，浏览器会自动拦截  
X-XSS-Protection：
    - 0 关闭
    - 1 打开，默认值
- 针对 HTML 内容，可以通过将 < 和 > 进行转译
```js
var escapeHtml = function(str) {
  if(!str) return '';
  str = str.replace(/</g, '&lt;');  // 转译 <
  str = str.replace(/>/g, '&gt;');  // 转译 >
  return str;
}
```
- 针对 HTML 属性，可以将双引号、单引号和空格进行转译
```js
var escapeHtmlProperty = function(str) {
  if(!str) return '';
  str = str.replace(/"/g, '&quto;');  // 转译双引号，针对这种情况： <img src="#{image}" />
  str = str.replace(/'/g, '&#39;');   // 转译单引号，针对这种情况：<img src='#{image}' />
  str = str.replace(/ /g, '&#32;');   // 转译空格，针对这种情况：<img src=#{image} />
  return str;
}
```
- 针对 js 代码，转义"\"或者转换成json
```js
var escapeForJs = function(str) {
  if(!str) return;
  str = str.replace(/\\/g, '\\\\');   // 转义 \
  str = str.replace(/"/g, '\\"');   // 转义双引号
  return str;
}
// 或者将 str 转换成 json
var str = JSON.stringify(str)
```
- 富文本  
使用黑名单过滤：将指定标签或属性进行过滤。  
缺点：HTML的标签和属性很多，很容易遗漏。
```js
var xssFilter = function(html) {
  if(!html) return '';
  html = html.replace(/<\s*\/?script\s*/g, '');   // 替换 script
  html = html.replace(/javascript:[^'"]*/g, '');  // <a href=\"javascript:alert(1)\"></a>
  html = html.replace(/onerror\s*=\s*['"]?[^'"]*/g, '');  // <img src="abc" onerror="alert(1)" />
  // 等等等 还有很多需要过滤的标签
  return html;
}
```
使用白名单过滤：按白名单保留部分标签和属性。  
第三方工具：[js-xss](https://github.com/leizongmin/js-xss/blob/master/README.zh.md)  
也可以使用 [cheerio](https://github.com/cheeriojs/cheerio) 做 html 解析，然后自己做白名单过滤。
```js
var xssFilter = function(html){
  var cheerio = require('cheerio');
  var $ = cheerio.load(html);
  var whiteList = {
    'img': ['src'],
    'font': ['color', 'size'],
    'a': ['href']
  }
  $('*').each(function(index, elem) {
    // 过滤标签
    if(!whiteList[elem.name]){
      $(elem).remove()
      return;
    }
    for(var attr in elem.attribs){
      // 过滤属性
      if(whiteList[elem.name].indexOf(attr) === -1){
        $(elem).attr(attr, null);
      }
    }
  })
  return $.html();
}
```

