# 数组 Array

## API
- forEach(function) 让数组中的每一项做一件事
- map(function) 让数组通过某种计算产生一个新数组
- filter(function) 筛选出数组中符合条件的项，组成新数组
- reduce(function) 让数组中的前项和后项做某种计算，并累计最终值
- every(function) 检测数组中的每一项是否符合条件，全部满足返回 true
- some(function) 检测数组中是否有某些项符合条件，只要满足一个即返回 true

## 数组去重：  
用Set为数组去重  
```
var arr = [1,2,2,3,4]  // 需要去重的数组
var set = new Set(arr) // {1,2,3,4}
var newArr = Array.from(set) // 再把set转变成array
console.log(newArr) // [1,2,3,4]
```

## 将类数组转换为真正的数组
```
function foo() {
 var arr = Array.prototype.slice.call( arguments );
 arr.push( "bam" );
 console.log( arr );
}
foo( "bar", "baz" ); // ["bar","baz","bam"]
```

## 数组复制
