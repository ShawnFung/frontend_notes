# transform

## 参考文档

## transform-origin 变形原点


## 多元素的变形相消
当一个元素的transform添加了多个变换函数时，其效果等同于按照这些变换函数的顺序依次分散添加在多层元素中。
```html
<div style="transform:translate(-10px,-20px) scale(2) rotate(45deg) translate(5px,10px)"></div>
```
其变换结果等效于：
```html
<div style="transform:translate(-10px,-20px)">
  <div style="transform:scale(2)">
    <div style="transform:rotate(45deg)">
      <div style="transform:translate(5px,10px)">
      </div>
    </div>
  </div>
</div>
```

## 内层元素可以通过变形来抵消外层的变形效果。
```html
<div style="transform:rotate(45deg) rotate(-45deg)"></div>
```
显然，这个元素其实是没有旋转的，因为两个旋转变换函数刚好抵消。这时候，我们再用一下前面的规则，就知道它等同于：
```html
<div style="transform:rotate(45deg)">
    <div style="transform:rotate(-45deg)"></div>
</div>
```





