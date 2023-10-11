# line-height

## line-height 继承
子元素未设置行高，会自动继承父元素的行高
```css
.father{
  font-size: 20px;
  line-height: 20px;  // 父元素行高为具体数值，子元素则继承该值
  line-height: 2;     // 父元素行高为比例，子元素则继承该比例
  line-height: 200%;  // 父元素行高为百分比，则继承计算出来的值，此时子元素行高 = 20px * 200% = 40px;
}
.son{
  font-size: 16px;
}
```

