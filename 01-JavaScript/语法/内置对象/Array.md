# 数组 Array

## 数组去重：  
用Set为数组去重  
```js
let arr = [1,2,2,3,4];
let newArr = Array.from(new Set(arr));
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
