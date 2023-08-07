# React Hooks

- Hooks 使用规则
- useState
- useRef
- useMemo
- useCallback
- 第三方 Hooks

## Hooks 使用规则
- 必须使用 useXxx 格式命名
- 只能在两个地方调用 Hook（组件内，其他 Hook 内）
- 必须保证每次的调用顺序一致（不能放在 if、for 内部），Hook 必须是组件“第一层代码”

## useState
- 任何 state 的更新，都会触发组件的更新？
- 异步更新
```JSX
const [count, setCount] = useState(0)
setCount(count + 1)
console.log(count)  // 此时打印出来的是 0，因为 useState 是异步更新的
```
- 使用函数，state 更新不会被合并
```JSX
const [count, setCount] = useState(0)
setCount(count => count + 1)
setCount(count => count + 1)
setCount(count => count + 1)
// count 最终变成了 3
```
- 如果一个变量不用于 JSX 中显示，那就不要用 useState 来管理它，用 useRef
- **不可变数据！！**，要使用 setXXX 来更新 state 的值
```JSX
const [userInfo, setUserInfo] = useState({ name: 'Jony', age: 12 })
setUserInfo({ ...userInfo, age: 15 })
```

## useRef
- 一般用于操作 DOM
- 也可以传入普通 JS 变量，但更新时不会触发 rerender
```JSX
function Demo(){
  const inputRef = useRef(null)
  function selectInput(){
    const inputEl = inputRef.current;
    if(inputEl){
      inputEl.select()
    }
  }
  return <>
    <input ref={inputRef} value="hello" />
    <button onClick={selectInput}>选中 input</button>
  </>
}
```

## useMemo
`useMemo(callback[,[]])`  
当依赖项数组中的某个值发生变化时，`useMemo` 会重新计算回调函数。如果依赖项没有发生变化，`useMemo` 会返回上一次计算的结果，这样可以避免不必要的计算。  
主要用途：
- 优化性能：当组件重新渲染时，`useMemo` 可以避免重复执行开销较大的计算。
- `useMemo` **只能用作优化手段，而不应该用于实现语义上的正确性。**因为在某些情况下，React 可能会为了性能原因而跳过 useMemo，导致创建函数被重新执行。

## useCallback
`useCallback` 就是 `useMemo` 的语法糖，和 `useMemo` 一样。用于缓存函数。

## 自定义 Hooks

## 第三方 Hooks
- [ahooks](https://ahooks.js.org/zh-CN)
- [react-use](https://github.com/streamich/react-use)

## 闭包陷阱
当**异步函数**中获取 state 时，可能不是最新的 state 值。  
解决方案：替换为 `useRef` —— **但 ref 变化不会触发 rerender** ，所以得结合 state 一起
```JSX
const [count, setCount] = useState(0)
const countRef = useRef(0)

useEffect(() => {
  countRef.current = count
}, [count])

setTimeout(() => {
  console.log(countRef.current)
}, 3000)
```

### [immer](https://immerjs.github.io/immer/zh-CN/) 简化了不可变数据结构的处理