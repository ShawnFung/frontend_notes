# flexbox 弹性布局

## 属性
容器属性有：
- flex-direction 主轴的方向
  - row | row-reverse | column | column-reverse; 
- flex-wrap 容器内项目是否可换行
  - nowrap | wrap | wrap-reverse;
- flex-flow 是flex-direction属性和flex-wrap属性的简写形式，默认值为row nowrap
  - `<flex-direction>` || `<flex-wrap>`;
- justify-content 项目在主轴上的对齐方式
  - flex-start | flex-end | center | space-between | space-around
- align-items 项目在交叉轴上的对齐方式
  - flex-start | flex-end | center | baseline | stretch;
- align-content 多根轴线的对齐方式。如果项目只有一根轴线，该属性不起作用
  - flex-start | flex-end | center | space-between | space-around | stretch;

容器成员属性：
- order 项目的排列顺序。数值越小，排列越靠前，默认为0
- flex-grow 上面讲到当容器设为flex-wrap: nowrap;不换行的时候，容器宽度有不够分的情况，弹性元素会根据flex-grow来决定定义项目的放大比例（容器宽度>元素总宽度时如何伸展），默认为0，即如果存在剩余空间，也不放大
- flex-shrink 项目的缩小比例（容器宽度<元素总宽度时如何收缩），默认为1，即如果空间不足，该项目将缩小
- flex-basis 元素在主轴上的初始尺寸
  - `<length>` | `auto`; /* default auto */
- flex 是flex-grow, flex-shrink 和 flex-basis的简写，默认值为0 1 auto。
  - flex: 1 = flex: 1 1 0%
  - flex: 2 = flex: 2 1 0%
  - flex: auto = flex: 1 1 auto
  - flex: none = flex: 0 0 auto，常用于固定尺寸不伸缩
- align-self 允许单个项目有与其他项目不一样的对齐方式，可覆盖align-items属性，默认值为auto，表示继承父元素的align-items属性，如果没有父元素，则等同于stretch
  - auto | flex-start | flex-end | center | baseline | stretch;

## flex-basis 与 width 属性
- 优先级：max-width/min-width > flex-basis > width > box
- 如果没有设置 flex-basis 属性，那么 flex-basis 的大小就是项目的 width 属性的大小
- 如果没有设置 width 属性，那么 flex-basis 的大小就是项目内容(content)的大小