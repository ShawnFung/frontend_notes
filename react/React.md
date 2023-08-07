# React

- 状态提升
- 受控组件
```JSX
const [text, setText] = useState('')
<input onChange={e => setText(e.target.value)} value={text} ></input>
```

## props
- 从父组件向子组件传递数据、函数。

## 如何修改通过 create-react-app 创建的项目的配置
前端修改 `devServer` ，参考 craco.config.js

扩展 webpack 配置
- 使用 craco https://github.com/dilanx/craco
- 可参考[create-react-app扩展webpack配置](https://www.lingjie.tech/article/2021-01-04/27)

## 状态提升
数据存储在父组件，通过 props 传递给子组件

