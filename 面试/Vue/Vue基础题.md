# Vue基础题

## vue的生命周期？
- beforeCreate -> created -> beforeMount -> mounted
- beforeUpdate -> updated
- beforeDestroy -> destroyed

## 组件A下有子组件B、C，那么3个组件生命周期的调用顺序，同级组件mounted触发一定是先调用先call吗？同步还是异步？
初始化事件的调用顺序：  
A beforeCreate -> A created -> A beforeMount ->  
B beforeCreate -> B created -> B beforeMount ->  
C beforeCreate -> C created -> C beforeMount ->  
B mounted -> C mounted -> A mounted  

销毁事件的调用顺序：  
A beforeDestory ->   
B beforeDestroy -> B destroyed ->  
C beforeDestroy -> C destroyed ->   
A destroyed  
