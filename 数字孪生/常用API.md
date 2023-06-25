# 常用API

## drawArrays(mode, first, count) 按顶点绘制
mode 参数
- gl.POINTS	点；	一系列点，依次绘制
- gl.LINES	线段；	每两个一组绘制线段，若点的数目为奇数，最后一个点会被舍弃
- gl.LINES_STRIP	线条；	所有的点依次相连
- gl.LINE_LOOP	回路；	再线条的基础上，将首尾点相连
- gl.TRIANGLES	三角形；	每三个一组绘制三角形，若点的数目无法被三整除，剩余的点会被舍弃
- gl.TRIANGLES_STRIP	三角带；	一系列条带状的三角形，每个三角形都存在一条边共享
- gl.TRIANGLES_FAN	三角扇；	类似于扇形的图形

顶点绘制顺序，它决定了三角形的面是否朝向观察者。朝向观察者的三角形为正面三角形，否则为背面三角形。在许多情形中，WebGL不需要对背面三角形进行光栅化处理。
- 三角形的顶点绘制顺序默认是逆时针，即逆时针顺序绘制的三角形是正面三角形。
- 可以通过 gl.frontFace() 修改顶点绘制顺序

## drawElements(mode, count, type, offset) 按索引绘制
- mode：绘制模式，与gl.drawArrays() 相同
- count: 绑定元素数组缓冲区的元素数
- type：元素数组缓冲区中值的类型,枚举如下：
  - gl.UNSIGNED_BYTE
  - gl.UNSIGNED_SHORT
- offset：元素数组缓冲区中的字节偏移量

## 图形绘制

