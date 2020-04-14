# 怎么让一个 div 水平垂直居中 
```html
<div class="parent">
  <div class="child"></div>
</div>
```

## 宽高固定
### 绝对定位 + 负边距
```css
div.parent {
    position: relative; 
}
div.child {
    position: absolute;
    width: 50px;
    height: 10px;
    top: 50%;
    left: 50%;
    margin-left: -25px;
    margin-top: -5px;
}
```

### 绝对定位 + margin
```css
div.parent {
    position: relative; 
}
div.child {
    position: absolute;
    width: 50px;
    height: 10px;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    margin: auto;
}
```

## 未知宽高
### flex布局
```css
div.parent {
    display: flex;
    justify-content: center;
    align-items: center;
}
```
```css
div.parent{
    display: flex;
}
div.child{
    margin: auto;
}
```

### 绝对定位 + transform
```css
div.parent {
    position: relative; 
}
div.child {
    position: absolute; 
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);  
}
```

### table布局 + vertical-align
```css
div.parent {
    display: table;
}
div.child {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}
```

### inline-block + 伪元素 + vertical-align
```css
div.parent {
    font-size: 0;
    text-align: center;
}
div.parent::before {
    content: "";
    display: inline-block;
    width: 0;
    height: 100%;
    vertical-align: middle;
}
div.child{
    display: inline-block;
    vertical-align: middle;
}
```
