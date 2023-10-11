# transform

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

## tansform会导致其内部元素的fixed定位失效
tansform会导致其内部元素的fixed定位失效，变为absolute定位；[示例](https://newbieyoung.github.io/SomeBugs/bug-about-transform-fixed/demo0.html)；  
- 原因：在于transform影响了fixed定位元素的堆叠上下文，简单来说fixed定位的元素，如果其祖先元素存在非none的transform值，那么该元素将相对于设定了transform的祖先元素定位，而不是原本相对于视口。  
- 解决方案：可以通过把元素单独抽离出来并在外部多添加一层，外部容器层使用fixed定位，内部元素使用absolute定位来解决。

## 参考文档
1. [CSS3 transform对普通元素的N多渲染影响](https://www.zhangxinxu.com/wordpress/2015/05/css3-transform-affect/)
2. [搞定这些疑难杂症，向css3动画说yes](http://imweb.io/topic/5643850eed18cc424277050e)





