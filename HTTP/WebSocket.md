# WebSocket
WebSocket 的2个问题：
- 浏览器兼容性。许多浏览器不支持WebSocket协议。
- 通信形式层级过低。WebSocket是一个消息架构，它是处在TCP上非常薄的一层，会将字节流转化为文本/二进制消息，不强制使用任何特定的消息协议，它依赖于应用层解释消息的含义。

## SockJS
SockJS是一个JavaScript库，为了应对许多浏览器不支持WebSocket协议的问题，设计了备选SockJs。SockJS 是 WebSocket 技术的一种模拟。SockJS会尽可能对应 WebSocket API，但如果 WebSocket 技术不可用的话，会自动降为轮询的方式。Spring框架提供了基于SockJS协议的透明的降级选项。

## STOMP 协议
STOMP(Simple Text-Orientated Messaging Protocol) 面向消息的简单文本协议。  
SockJS 为 WebSocket 提供了备选方案。但无论哪种场景，对于实际应用来说，这种通信形式层级过低。 STOMP协议为浏览器和 server 间的通信增加适当的消息语义。

## WebSocket、SockJs、STOMP三者关系
- WebSocket 是底层协议，SockJS 是 WebSocket 的备选方案，也是底层协议，而 STOMP 是基于 WebSocket（SockJS）的上层协议。

## 参考文档
- [SockJS](https://github.com/sockjs/sockjs-client)
- [stompjs](https://github.com/stomp-js/stompjs)
- [在vue中使用SockJS实现webSocket通信](https://www.cnblogs.com/chris-oil/p/10889361.html)
- [websocket+sockjs+stompjs详解及实例](https://segmentfault.com/a/1190000017204277)
