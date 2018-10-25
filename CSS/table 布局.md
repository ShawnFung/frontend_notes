# Table

## table中head固定，body滚动
- [纯CSS,table的thead固定,tbody显示滚动条](https://www.cnblogs.com/yaoqj/p/4649341.html)  
- 原理：display: table 不支持 overflow 属性。所以要将 thead 和 tbody 的 display 属性值设置为 block。
```css
thead {
  display: block;
}
tbody {
  display: block;
  height: 100px;
  overflow-y: auto;
}
.wt40{
  width:300px;
}
.wt50{
  width:450px;
}
```
```html
<table class="tablediv" border="1"> 
  <thead>
    <tr>
      <td class="wt40">111asdasdassd</td>
      <td class="wt50">222asdsa</td>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td class="wt40">aaaaaaa23423d</td>
      <td class="wt50">bbbbb23w23sd</td>
    </tr>
  </tbody>
</table>
```
