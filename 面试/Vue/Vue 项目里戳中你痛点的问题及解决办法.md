# Vue 项目里戳中你痛点的问题及解决办法

## 参考文档
- [Vue 项目里戳中你痛点的问题及解决办法](https://juejin.im/post/5b174de8f265da6e410e0b4e)

## [程序化的事件侦听器](https://cn.vuejs.org/v2/guide/components-edge-cases.html#%E7%A8%8B%E5%BA%8F%E5%8C%96%E7%9A%84%E4%BA%8B%E4%BB%B6%E4%BE%A6%E5%90%AC%E5%99%A8)
```
mounted: function () {
  this.timer = (() => {
      // 某些操作
  }, 1000)
},
beforeDestroy: function () {
  clearInterval(this.timer);        
  this.timer = null;
}
```
程序化的侦听器
```
mounted: function() {
  const timer = setInterval(() =>{                    
      // 某些操作
  }, 1000);            
  // 通过$once来监听定时器，在beforeDestroy钩子可以被清除。
  this.$once('hook:beforeDestroy', () => {            
      clearInterval(timer);                                    
  })
}
```

## CSS的coped私有作用域和深度选择器

