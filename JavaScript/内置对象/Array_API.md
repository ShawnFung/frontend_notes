### Array Api

| 方法 | 描述 | 参数 | 返回值 | 是否会改变原数组 |
| --- | ----- | ----- | ---- | ---------------- |
| concat() | 合并两个或多个数组 | Array | 新的数组 | 否 |
| pop() | 删除并返回数组的最后一个元素 | 无 | 从数组中删除的元素(当数组为空时返回undefined) | 是 |
| shift() | 删除并返回数组的第一个元素 | 无 | 从数组中删除的元素; 如果数组为空则返回undefined | 是 |
| push() | 将一个或多个元素添加到数组的末尾 | 要添加的元素 | 新数组的长度 | 是 |
| unshift() | 将一个或多个元素添加到数组的开头 | 要添加的元素 | 新数组的长度 | 是 |
| splice() | 删除元素，并向数组添加新元素 | start, deleteCount, newItem | 由被删除的元素组成的一个数组 | 是 |
| fill() | 用一个固定值填充一个数组中从起始索引到终止索引内的全部元素 | value, start, end | 新的数组 | 否 | 
| slice() | 从某个已有的数组返回选定的元素 | begin, end | 新的数组 | 否 |
| forEach() | 循环数组 | callback | undefined | 不一定 |
| every() | | callback | true or false | 否 |
| some() | | callback | true or false | 否 |
| filter() | 数组过滤 | callback | 新的数组 | 否 |
| map() | 创建新数组 | callback | 新的数组 | 否 |
| reduce() | 函数累加器 | callback(accumulator, currVal, currIndex), initialValue | 函数累计处理的结果 | 否 | 
| reduceRight() | 与 reduce 的执行方向相反 | callback(accumulator, currVal, currIndex), initialValue | 函数累计处理的结果 | 否 |
| reverse() | 颠倒数组中元素的顺序 | 无 | 原数组的引用 | 是 |
| sort() | 对数组的元素进行排序 | compareFunction | 返回排序后的数组 | 是 |
| find() | 查找目标元素 | callback | 找到就返回该元素，找不到返回undefined | 否 |
| findIndex() | 查找目标元素 | callback | 找到就返回元素的位置，找不到就返回-1 | 否 |
| indexOf() | 指定元素在数组的第一个索引 | searchElement, fromIndex | 如果不存在，则返回-1 | 否
| lastIndexOf() | 指定元素在数组中的最后一个的索引 | searchElement, fromIndex | 如果不存在，则返回-1 | 否 |
| join() | 将一个数组（或一个类数组对象）的所有元素连接成一个字符串 | separator | 字符串 | 否 |


```
// sort 排序不一定是稳定的。默认排序顺序是根据字符串Unicode码点。
var scores = [1, 10, 21, 2]; 
scores.sort();   // [1, 10, 2, 21]
```


参考文档：
1. [Array MDN](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Array)