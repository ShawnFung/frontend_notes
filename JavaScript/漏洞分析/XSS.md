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