# CSS 阴影技巧与细节

```
box-shadow: offset-x offset-y blur spread color inset;
```
- x 偏移值
- y 偏移值
- 模糊半径
- 扩张半径

## [单侧投影](https://codepen.io/Chokcoco/pen/pergRb)
单侧投影的核心是第四个参数：扩张半径。当扩张半径=负的模糊半径时，除非使用偏移量来移动他，否则我们将看不到任何投影。
```css
{
  box-shadow: -7px 0 5px -5px #333; // 左侧单侧投影
  box-shadow: 7px  0 5px -5px #333; // 右侧单侧投影
  box-shadow: 0 -7px 5px -5px #333; // 上侧单侧投影
  box-shadow: 0  7px 5px -5px #333; // 下侧单侧投影
}
```
