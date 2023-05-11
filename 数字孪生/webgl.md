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

## 缓冲区对象
在 webgl 中开辟一块独立的内存区，将需要绘制的顶点数据全部填充至缓冲区内，供顶点着色器使用。  
流程：
- 创建缓冲区对象 
- 绑定缓冲区对象
- 将数据写入缓冲区对象
- 给 attribute 赋值 gl.vertexAttribPointer
- 开启 attribute 变量 gl.enableVertexAttribArray
```
var vertices = new Float32Array([
  0.0, 0.5,
  -0.5, -0.5,
  0.5, -0.5
]);
const buffer = gl.createBuffer()
gl.bindBuffer(gl.ARRAY_BUFFER, buffer)
gl.bufferData(gl.ARRAY_BUFFER, vertices, gl.STATIC_DRAW)
var a_Position = gl.getAttribLocation(gl.program, 'a_Position');
gl.vertexAttribPointer(a_Position, 2, gl.FLOAT, false, 0, 0);
gl.enableVertexAttribArray(a_Position);
gl.drawArrays(gl.POINTS, 0, 3)
```

### 数据偏移
使用 vertexAttribPointer 解决多缓存区问题。可以存多种数据，不同数据间通过偏移来区分，这样就可以只需要一个缓冲区数据了。
```
void gl.vertexAttribPointer(index, size, type, normalized, stride, offset);
```
- index，通过 gl.getAttribLocation(gl.program, "a_Position") 方法可以返回 a_Position 属性的索引
- size，你需要取几个数据
- type，指定数据类型，gl.FLOAT, gl.BYTE 等等数据类型，一般为 gl.FLOAT
- normalized，对于参数 gl.FLOAT 无效
- stride，每次拿数据时的间隔。首先拿到 const FSIZE = verties.BYTES_PER_ELEMENT, 也就是数组的字节长度，必须是字节长的倍数。
- offset，偏移量，必须是字节长的倍数。


## 类型化数组
数组中所有元素的值都被指定为某一特定类型。  
- Int8Array 8位整型
- UInt8Array 8位无符号整型
- Int16Array 16位整型
- UInt16Array 16位无符号整型
- Int32Array 32位整型
- UInt32Array 32位无符号整型
- Float32Array 单精度32位浮点型
- Float64Array 单精度64位浮点型

## 矩阵
webgl 按照列主序的规则将矩阵存储于数组，如果是行向量，向量要放在左侧相乘。如果是列向量，向量要放在右侧相乘。
```
new Float32Array([
  a,  e,  i,  m,
  b,  f,  j,  n,
  c,  g,  k,  o,
  d,  h,  l,  p,
]) 
```
### 平移矩阵
```
const vertex = `
  attribute vec4 aPosition;
  uniform mat4 mat;
  void main() {
    gl_Position = mat * aPosition;
  }
`
function getTranslateMatrix(x=0, y=0, z=0){
  return new Float32Array([
    1.0, 0.0, 0.0, 0.0,
    0.0, 1.0, 0.0, 0.0,
    0.0, 0.0, 1.0, 0.0,
    x,   y,   z,   1,
  ])
} 
let translate = 0.5
const mat = gl.getUniformLocation(program, 'mat');
const matT = getTranslateMatrix(translate)
gl.uniformMatrix4fv(mat, false, matT)
```
### 缩放矩阵
```
function getScaleMatrix(x=0, y=0, z=0){
  return new Float32Array([
    x, 0.0, 0.0, 0.0,
    0.0, y, 0.0, 0.0,
    0.0, 0.0, z, 0.0,
    0.0, 0.0, 0.0, 1,
  ])
} 
```
### 旋转矩阵
```
function getScaleMatrix(deg){
  return new Float32Array([
    Math.cos(deg), Math.sin(deg), 0.0, 0.0,
    -Math.sin(deg),Math.cos(deg), 0.0, 0.0,
    0.0,           0.0,           1.0, 0.0,
    0.0,           0.0,           0.0, 1.0,
  ]);
}
```

## webgl 渲染流程
- 顶点坐标
- 图元装配 gl.drawArrays()
- 光栅化 
  - 剔除
  - 裁剪
- 图形绘制

## 使用纹理
WebGL 对纹理图片大小是有要求的，图片的宽度和高度必须是2的N次幂，比如 16 x 16，32 x 32，32 x 64 等。
### 纹理坐标，也成为 st 坐标
- 图片的坐标系统跟 canvas 的坐标系统相同，但是跟 webgl 的坐标不同，所以需要进行转换，转换后的图片坐标被称为纹理坐标。
- s 代表横轴坐标，t 代表纵轴坐标，他们的范围都是 0 到 1。不管纹理图像本身的长宽是多少，都处于这个坐标系下。
### 贴图流程
- uv坐标数据准备
- 加载外部纹理图像
- 纹理配置
  - 创建纹理对象
  - 图像Y轴反转
  - 激活纹理单元并绑定至纹理对象
  - 配置纹理对象参数
  - 纹理图像分配给纹理对象
  - 纹理单元传递给着色器
- 绘制
```
const img = new Image();
img.onload = function() {
  // 创建纹理对象
  const texture = gl.createTexture();
  // 翻转 图片 Y轴
  gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, 1)
  // 开启一个纹理单元
  gl.activeTexture(gl.TEXTURE0);
  // 绑定纹理对象
  gl.bindTexture(gl.TEXTURE_2D, texture);
  // 处理放大缩小的逻辑
  gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR)
  gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR)
  // 横向 纵向 平铺的方式
  gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE)
  gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE)
  // 配置纹理图像
  gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGB, gl.RGB, gl.UNSIGNED_BYTE, img);
  gl.uniform1i(uSampler, 0);
  gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
}
img.src = '../assets/content.png'
```

## 参考文档
- [官方文档](https://developer.mozilla.org/zh-CN/docs/Web/API/WebGL_API)
- [一起学 WebGL：坐标系](https://zhuanlan.zhihu.com/p/615919060?utm_id=0)
- [02-WebGL缓冲区对象](https://www.jianshu.com/p/a31c1f3f9ba3)
- [webgl变换：深入图形平移](https://zhuanlan.zhihu.com/p/356123876)
- [webgl变换：深入图形旋转](https://zhuanlan.zhihu.com/p/361920057)
- [webgl变换：深入图形缩放](https://zhuanlan.zhihu.com/p/356123876)
- [webgl纹理贴图机制](https://blog.csdn.net/qq_37987033/article/details/128745577)