# transform

## 参考文档
1. [CSS3 transform对普通元素的N多渲染影响](https://www.zhangxinxu.com/wordpress/2015/05/css3-transform-affect/)
2. [搞定这些疑难杂症，向css3动画说yes](http://imweb.io/topic/5643850eed18cc424277050e)

## 父元素设置了transform属性后，导致子元素的position:fixed设置无效。
任何非none值的transform会导致创建一个堆栈上下文和包含块。所以如果父级元素设置了transform属性，position:relative/absolute/fixed会基于此定位。  


