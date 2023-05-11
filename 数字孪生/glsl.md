# GLSL

## 语言基础
- 大小写敏感
- 强制分号
- 程序入口，没有入参，也没有返回值
  ```
  void main(){}
  ```
- 注释
  - 单行注释 ```//```
  - 多行注释 ```/**/```

## 变量声明
```
类型 变量名;
float f;
```
变量名规则
- 数字字母下划线
- 不能以数字开头
- 不能是关键字或保留字
- 不能以 gl_、webgl_、_webgl_ 作为开头

## 分支和循环
分支：
- if(){} 和 if(){} else{}
- if(){} else if(){} else{}  

循环：
- for(){}
- while(){}
- do() while{}  

跳出循环
- continue
- break
- discard 只能在片元着色器使用，表示放弃当前片元直接处理下一个片元

## 强类型语言
基本类型
- float 单精度浮点数
- int 整型
- bool 布尔值  

数据类型转换
- int() 转为整型
- float() 转为浮点型
- bool() 转为布尔值  

### 矢量
- vec2、vec3、vec4 具有 2，3，4 个浮点数元素的矢量
- ivec2、ivec3、ivec4 具有 2，3，4 个整型元素的矢量
- bvec2、bvec3、bvec4 具有 2，3，4 个布尔型元素的矢量

#### 赋值
需要通过构造函数来进行赋值
```
// vec4() 就是矢量的构造函数
vec4 position = vec4(0.1,0.2,0.3,1.0)
```
访问分量
- x，y，z，w 访问顶点坐标的分量
- s，t，p，q 访问纹理坐标的分量
- 使用混合的方式获取多个值
  ```
  position.yx  // vec2(0.2, 0.1)
  ```

### 矩阵
- mat2、mat3、mat4 分别是 2*2，3*3，4*4 的浮点数元素矩阵
- 矩阵参数是列主序的。
```
mat4 m = mat4(
  1.0, 5.0, 9.0,  13.0,
  2.0, 6.0, 10.0, 14.0,
  3.0, 7.0, 11.0, 15.0,
  4.0, 8.0, 12.0, 16.0,
)
```

### 纹理取样器
- sampler2D、samplerCube
- 只能申明为 uniform 变量

## 函数
```
返回值类型 函数名称(入参类型 入参名称){
  // 如果有返回值，需要使用 return 来返回
}
```

### 内置函数
角度函数
- radians 角度转弧度
- degress 弧度转角度

三角函数
- sin 正弦
- cos 余弦
- tan 正切
- asin 反正弦
- acos 反余弦
- atan 反正切

指数函数
- pow 次方
- exp 自然质数
- log 对数
- sqrt 开平方
- inversesqrt 开平方的倒数

通用函数
- abs 绝对值
- min 最小值
- max 最大值
- mod 取余数
- sign 取符号
- floor 向下取整
- ceil 向上取整
- clamp 限定范围
- fract 获取小数部分

几何函数
- length(x) 计算向量 x 的长度
- distance(x, y) 计算向量 xy 之间的距离
- dot(x,y) 计算向量 xy 的点积
- cross(x,y) 计算向量 xy 的差积
- normalize(x) 返回方向同 x，长度为 1 的向量

## 存储限定词
### const 
声明一个常量，定义后不能被改变

### attribute
变量声明
- 只能在顶点着色器中使用，只能声明为全局变量
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

### uniform
变量申明：
- 在使用 uniform 时必须在前一行添加 precision mediump float; 确定精度，因为片元着色器中并没有默认的 float 精度。
```
存储限定符 类型 变量名;
uniform vec4 u_color;
```
示例：
```
let fragmentSource = `
precision mediump float;
uniform vec3 u_color;
void main (){
  gl_FragColor = vec4(u_color, 1.0);
}
`
```

外部修改 uniform：
```
let color = gl.getUniformLocation(program, 'u_color');
// 根据 u_color 申明时的类型，选择合适维度的方法来赋值。
gl.uniform1f(color, 1);     // r
gl.uniform2f(color, 1, 0);     // r g
gl.uniform3f(color, 1, 0, 0);     // r g b
gl.uniform4f(color, 1, 0, 0, 1);     // r g b a
```

### varying
- 需要在顶点着色器和片元着色器中同时申明，且变量名要一致。
- 作用是从顶点着色器向片元着色器传递一些数据。

### 精度限定
使用 precision 修改着色器的默认精度。
- 低精度：lowp
- 中精度：mediump
- 高精度：highp
```
precision lowp float;
```
注意：片元着色器中的 float 类型没有默认精度，所以如果需要在片元着色器中使用浮点型数据时，需要指定精度
