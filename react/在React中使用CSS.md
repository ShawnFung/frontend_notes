# 在 React 中使用 CSS

- 内联样式
- 引入 CSS 文件
- CSS Module
- 使用 Sass、Less 等预处理工具
- CSS-in-JS

## 内联样式
- 必须是 JS 对象形式，不可以是字符串
- 样式名称用驼峰式写法，如 `fontSize`
```JSX
<div style={{ fontSize: '12px', backgroundColor: 'red'}}></div>
```

## 引入 CSS 文件
- JSX 中使用 className
```JSX
import './App.css'
<div className="list-item"></div>
```
- 可用第三方库 `clsx` 或 `classnames` 来进行条件判断
```JSX
import classnames from 'classnames'

const [isPressed, setIsPressed] = useState(false);
const [isHovered, setIsHovered] = useState(false);

const btnClass = classNames({
  btn: true,
  'btn-pressed': isPressed,
  'btn-over': !isPressed && isHovered,
});

// 动态 class 
let buttonType = 'primary';
classNames({ [`btn-${buttonType}`]: true });
```

## CSS Module
- 每个 CSS 都是一个独立的模块，命名 `xxx.module.css`
- 为每个 className 增加后缀名，不让它们重复
- Create-React-App 原生支持 CSS Module
```JSX
import styles from 'app.module.css'
<div classsName={styles['list-item']}></div>
```

## 使用 Sass
- Create-React-App 默认不支持 Sass Module，如需使用，需要安装相关依赖。执行 `npm install sass`，然后再重启一下即可。

## CSS-in-JS
用 JS 写，有逻辑有变量，非常灵活，适用于需要灵活变换样式的场景，但是会增加编译时间。
- [Styled-components](https://styled-components.com/)
- Styled-jsx，在 ts 环境下需要扩展相关属性，带来麻烦
- Emotion，在 ts 环境下需要扩展相关属性，带来麻烦