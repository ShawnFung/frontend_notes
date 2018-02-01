##  数组 ##

1. 数组去重：  
1.1 用Set为数组去重  
```
var arr = [1,2,2,3,4]  // 需要去重的数组
var set = new Set(arr) // {1,2,3,4}
var newArr = Array.from(set) // 再把set转变成array
console.log(newArr) // [1,2,3,4]
```

2. 将类数组转换为真正的数组
```
function foo() {
 var arr = Array.prototype.slice.call( arguments );
 arr.push( "bam" );
 console.log( arr );
}
foo( "bar", "baz" ); // ["bar","baz","bam"]
```

3. 数组复制
