# line-height

## 参考文档
- [line-height](http://www.css88.com/book/css/properties/text/line-height.htm)
- [无单位数字和行高](https://mp.weixin.qq.com/s/ilkmqnwVvPLjiVfEyNadHg)

## line-height 继承性和值
```html
<body>
  <p class="about-us">
    We have built partnerships with small farms around the world to
    hand-select beans at the peak of season. We then carefully roast in
    small batches to maximize their potential.  </p>
</body>
```
```css
body {
  font-size: 16px;
  line-height: 20px;   // 方案一 使用 length 长度，通常使用像素 px 或者 em 等单位
  line-height: 200%;   // 方案二 使用 percentage 百分比，
  line-height: 1.5;    // 方案三 使用 number 乘积因子
}
.about-us {
  font-size: 40px;
}
```

- 方案一 子元素的line-height = 20px，因为子元素行高 < 子元素的 font-size，所以字体会重叠。
- 方案二 子元素的line-height = 200% * 父元素 font-size = 32px。因为子元素行高 < 子元素的 font-size，所以字体会重叠。
- 方案三 子元素的line-height = 父元素行高的乘积因子 * 子元素 font-size = 2 * 40 = 80px。显示正常。
综上所述，给 line-height 设置值时，推荐使用不带单位的乘积因子。

