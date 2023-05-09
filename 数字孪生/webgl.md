# Webgl

## Webgl 与 canvas
在支持 HTML ```<canvas>``` 标签的浏览器中，不需要使用任何插件，便可以使用基于 OpenGL ES 2.0 的 API 在 canvas 中进行 3D 渲染。
```
var gl = canvas.getContext('webgl');
或者
var gl = canvas.getContext('webgl2');
```

## 着色器 shader
- 顶点着色器 Vertex shader
- 片元着色器 Fragment Shader

### 流程
每个program对象有且仅有一个 Vertex shader 对象和一个 Fragment Shader 对象连接到它。
- 编写 shader 代码
- 创建 shader 实例，
- 将 shader 实例 和 shader 源码关联起来
- 编译 shader 源码
- 创建 program 实例
- 绑定 shader 到 program
- 链接program
- 使用program
```
const vertexShaderSource = '...'
// 创建顶点渲染器
const vertexShader = gl.createShader(gl.VERTEX_SHADER)
gl.shaderSource(vertexShader, vertexShaderSource)
gl.compileShader(vertexShader)
// 程序对象
const program = gl.glCreateProgram()
gl.attachShader(program, vertexShader)
gl.linkProgram(program)
gl.useProgram(program)
```

### attribute 变量
变量声明
- 注意：分号必须要存在
- 只能在顶点着色器中使用
```
存储限定符 类型 变量名;
attribute vec4 a_position;
```
外部修改 attribute：
```
const a_Position = gl.getAttribLocation(program, "a_Position");
gl.vertexAttrib1f(a_Position, 0.0);
gl.vertexAttrib2f(a_Position, 0.0, 0.5);
gl.vertexAttrib3f (a_Position, 0.0, 0.5, 0.0);
gl.vertexAttrib4f(a_Position, 0.0, 0.5, 0.0, 1.0); // x, y, z, w
// 缺少的 y、z 默认会用 0.0，w 则使用 1.0
```

## 坐标
- 默认使用笛卡尔坐标系的右手坐标系，满足右手定则，即 x 轴向右，y 轴向上，z 轴向着观察者，原点位于画布中心。  
- 坐标值，使用的是百分比。比如对于 x 维度，取值范围为 [-1, 1]。比如 -1 表示在屏幕的最左侧，1 表示在屏幕的最右侧，0 则是在原点，0.5 表示在 x 正半轴的 1/2 处。其他维度同理。  
![webgl坐标系](./images/webgl%E5%9D%90%E6%A0%87%E7%B3%BB.webp)  
- 浏览器上的点击事件，其坐标位置（e.clientX 和 e.clientY）使用的坐标系系统和 WebGL 不同。该坐标系的原点位于左上角，x 向右，但 y 是向下的。   
- 浏览器坐标转 WebGL 坐标
```
// 屏幕上的坐标转 canvas 上的坐标
const x = ev.clientX
const y = ev.clientY
const domPosition = ev.target.getBoundingClientRect()
const domX = x - domPosition.left
const domY = y - domPosition.top
// canvas 上的坐标转 webgl 坐标
const newX = (domX - canvas.width / 2) / (canvas.width / 2);
const newY = (canvas.height / 2 - domY) / (canvas.height / 2);
```

## 事件
可以通过在 canvas 上添加事件

## 参考文档
- [一起学 WebGL：坐标系](https://zhuanlan.zhihu.com/p/615919060?utm_id=0)