# Select 组件

## 参考文档
- [论如何实现一个完美的Select组件](https://juejin.im/post/5b02b960f265da0b9e655e61?utm_medium=fe&utm_source=weixinqun)
- [面向Vue新人：使用Vue自定义指令来完善一个Select组件](https://juejin.im/post/5b03e610f265da0b873ad64e)

## render in body
需要解决以下两个问题：
- 如何避免其他元素对 DropdownMenu 的影响？及对 DropdownMenu 其他元素的影响？(render in body)
- Selection 和 DropdownMenu 分离在不同 DOM 层级，相对位置如何计算？页面滚动时，两者的位置能保证不变吗？

## 位置计算与滚动同步
计算思路：元素相对可视区的距离 + 页面滚动距离
```
element.getBoundingClientRect.top/left + documentElement.scrollTop/Left
```
采用上面这种计算思路时，
- 当页面级别的滚动时，Selection 与 DropdownMenu 的位置可以保证同步。
- 当 Selection 所处的独立区域滚动时，位置就会发生错乱。

## vue 如何将组件添加到 body 上？