# 为什么前端监控要用GIF打点

## 参考文档
- [为什么前端监控要用GIF打点](https://mp.weixin.qq.com/s/v6R2w26qZkEilXY0mPUBCw)

## 前端监控的原理
在满足一定条件后，由Web页面将用户信息（UA/鼠标点击位置/页面报错/停留时长/etc）上报给服务器的过程。  
向服务器端上报数据，可以通过
- 请求接口（ajax）
- 请求普通文件（js/css等）
- 请求图片资源的方式。  

为什么所有系统都统一使用了请求GIF图片的方式上报数据呢？

## image beacon
主要应用于只需要向服务器发送数据(日志数据)的场合，且无需服务器有消息体回应。比如收集访问者的统计信息。
```html
<script type="text/javascript">
 var thisPage = location.href;
 var referringPage = (document.referrer) ? document.referrer : "none";
 // 只需要 new Image()，不需要append到DOM中
 var beacon = new Image();
 beacon.src = "http://www.example.com/logger/beacon.gif?page=" + encodeURI(thisPage)
 + "&ref=" + encodeURI(referringPage);
</script>
```

## 总结
前端监控使用GIF进行上报主要是因为：
- 没有跨域问题，一般这种上报数据，代码要写通用的；（排除ajax）
- 不会阻塞页面加载，影响用户的体验，只要new Image对象就好了；（排除JS/CSS文件资源方式上报）
- 在所有图片中，体积最小；（比较PNG/JPG）
