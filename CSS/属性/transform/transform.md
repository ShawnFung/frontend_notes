# transform

## 参考文档
1. [CSS3 transform对普通元素的N多渲染影响](https://www.zhangxinxu.com/wordpress/2015/05/css3-transform-affect/)
2. [搞定这些疑难杂症，向css3动画说yes](http://imweb.io/topic/5643850eed18cc424277050e)

## tansform会导致其内部元素的fixed定位失效
tansform会导致其内部元素的fixed定位失效，变为absolute定位；[示例](https://newbieyoung.github.io/SomeBugs/bug-about-transform-fixed/demo0.html)；  
- 原因：在于transform影响了fixed定位元素的堆叠上下文，简单来说fixed定位的元素，如果其祖先元素存在非none的transform值，那么该元素将相对于设定了transform的祖先元素定位，而不是原本相对于视口。  
- 解决方案：可以通过把元素单独抽离出来并在外部多添加一层，外部容器层使用fixed定位，内部元素使用absolute定位来解决。

