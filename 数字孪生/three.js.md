# three.js

## 基本概念
### 场景 Scene，继承自 Object3D
- 物体形状
- 物体材质
- 网络模型
  - 模型位置
### 相机 Camera
- 正投影相机 OrthographicCamera (opens new window)
- 透视投影相机 PerspectiveCamera(fov, aspect, near, far)
  - 相机位置 camera.position.set(x, y, z); 
  - 相机观察点 camera.lookAt(x, y, z)

相机控件 [OrbitControls](http://www.webgl3d.cn/pages/837374/)，可以实现旋转缩放预览效果。
### 渲染器 WebGLRenderer
- 设置 Canvas 画布尺寸 renderer.setSize(width, height)
- 获取渲染器 Canvas 画布属性 renderer.domElement
- 渲染器渲染方法 renderer.render(scene, camera)

### 灯光
光源
- 环境光 AmbientLight
  - 没有特定的来源，不会影响阴影的形成
  - 不能作为场景中的唯一光源，需要配合其他光源使用
  - 用来减弱阴影，或者给物体添加一些颜色
- 点光源 PointLight
  - 会产生阴影
- 聚光灯 SpotLight
  - 会产生阴影
- 平行光，也就是太阳光 DirectionalLight
  - 会产生阴影

## 材质
物体材质
- 不受光照影响
  - MeshBasicMaterial
- 受光照影响
  - 漫反射：MeshLambertMaterial
  - 高光：MeshPhongMaterial
  - 物理
    - MeshStandardMaterial
    - MeshPhysicalMaterial

### MeshBasicMaterial
- 不受光照影响

## dat.gui.js
一个轻量级的图形用户界面库（GUI 组件），使用这个库可以很容易地创建出能够改变代码变量的界面组件

## 事件

## 参考文档
- [官网](https://threejs.org/docs/index.html#api/zh/helpers/PointLightHelper)
- [Three.js中文教程](http://www.webgl3d.cn/pages/4a14ce/)
- [dat.GUI库的使用详解](https://www.hangge.com/blog/cache/detail_1785.html)