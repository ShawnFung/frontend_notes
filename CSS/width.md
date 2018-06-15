## Width

### 参考文档


### 先看几道面试题
#### ```width: 100%``` 和 ```width: auto``` 区别？
width: auto 时：
- 父元素的 content = 子元素（content + padding + border + margin )。 
- 子元素有margin、border、padding时，会减去子元素content区域相对应的width值   

width: 100% 时：
- 父元素的 content = 子元素的content
- 子元素有margin、border、padding时，不改变子元素content区域的width，而是溢出父盒子。