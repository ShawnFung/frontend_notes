# Vue实践与技巧

## 利用Object.freeze()提升性能
vue 1.0.18+对其提供了支持，对于data或vuex里使用freeze冻结了的对象，vue不会做getter和setter的转换。  
场景：
- 纯展示的大数据，并且确信数据不会修改。
- 使用第三方插件创建的对象，例如使用echarts创建的地图对象等。
```js
new Vue({
    data: {
        // vue不会对list里的object做getter、setter绑定
        list: Object.freeze([
            { value: 1 },
            { value: 2 }
        ])
    },
    created () {
        // Object.freeze()冻结的是值，你仍然可以将变量的引用替换掉，从而实现数据响应
        this.list = [
            { value: 100 },
            { value: 200 }
        ];
        this.list = Object.freeze([
            { value: 100 },
            { value: 200 }
        ]);
    }
})
```
