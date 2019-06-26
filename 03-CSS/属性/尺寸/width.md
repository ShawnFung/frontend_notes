## Width

### 参考文档


### 先看几道面试题
#### ```width: 100%``` 和 ```width: auto``` 区别？
width: auto 时：
- 子元素(content + padding + border + margin) = 父元素的 content。 
- 子元素有 margin、border、padding 时，会减去子元素 content 区域相对应的 width 值   

width: 100% 时：
- 子元素的宽度(width) = 父元素的 content
- 子元素的宽度 width 会受到盒子模型(box-sizing)的影响。
- 子元素有 margin、border、padding 时，不改变子元素 content 区域的 width，而是溢出父盒子。