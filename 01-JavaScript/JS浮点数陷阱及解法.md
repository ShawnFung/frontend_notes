# JS浮点数陷阱及解法

## 参考文档
- [处理浮点数误差的第三方工具：number-precision](https://github.com/nefe/number-precision)

## toFixed()
```js
1.005.toFixed(2);   // 返回的是 1.00 而不是 1.01。
```
