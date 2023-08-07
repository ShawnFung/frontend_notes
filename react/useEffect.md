# useEffect

- Capture Value 特性
- useEffect 语法
- 常见场景
- useCallback

## Capture Value 特性
Capture Value 从字面上可以理解为固化的值。把每一次 render 理解为一次快照，每个快照独立，而每一次状态都被固化在了这个快照中（无论是在处理函数中还是在 useEffect 中）。
- 利用 `useRef` 就可以绕过 Capture Value 的特性。**可以认为 `ref` 在所有 Render 过程中保持着唯一引用，因此所有对 `ref` 的赋值或取值，拿到的都只有一个最终状态**，而不会在每个 Render 间存在隔离。

## useEffect 语法
`useEffect(callback[,[]])`  
一致性。**将注意放在依赖上（useEffect的第二个参数[]）**
- 当不传递第二个参数时，每次 render 都会执行一遍 callback 函数。
- 当传递第二个参数且是空数组时，只有第一次 render 才会执行 callback，类似于 componentDidMount
- 不管是否传递第二个参数，只要在 callback 中 return 一个函数，就相当于告诉 react 此组件挂掉之前执行什么操作，类似于 componentWillUnMount

## 常见场景
- 在第一次 render 时，添加一个定时器，在组件卸载时，清理定时器。

错误用法：
```JSX
function Counter() {
  const [count, setCount] = useState(0);

  useEffect(() => {
    const id = setInterval(() => {
      // 由于 useEffect 符合 Capture Value 的特性，拿到的 count 值永远是初始化的 0。相当于 setInterval 永远在 count 为 0 的 Scope 中执行，你后续的 setCount 操作并不会产生任何作用。
      setCount(count + 1);
    }, 1000);
    return () => clearInterval(id);
  }, []);

  return <h1>{count}</h1>;
}
```
正确用法：
```JSX
useEffect(() => {
  const id = setInterval(() => {
    setCount(c => c + 1);
  }, 1000);
  return () => clearInterval(id);
}, []);
```
不管更新时需要依赖多少变量，在调用更新的动作里都不需要依赖任何变量。
```JSX
const [state, dispatch] = useReducer(reducer, initialState);
const { count, step } = state;

useEffect(() => {
  const id = setInterval(() => {
     // Instead of setCount(c => c + step);
    dispatch({ type: "tick" });
  }, 1000);
  return () => clearInterval(id);
}, [dispatch]);
```

## useCallback
由于函数也具有 Capture Value 特性，经过 `useCallback` 包装过的函数可以当作普通变量作为 `useEffect` 的依赖。`useCallback` 做的事情，就是在其依赖变化时，返回一个新的函数引用，触发 `useEffect` 的依赖变化，并激活其重新执行。
```JSX
function Parent() {
  const [query, setQuery] = useState("react");

  // ✅ Preserves identity until query changes
  const fetchData = useCallback(() => {
    const url = "https://hn.algolia.com/api/v1/search?query=" + query;
    // ... Fetch data and return it ...
  }, [query]); // ✅ Callback deps are OK

  return <Child fetchData={fetchData} />;
}

function Child({ fetchData }) {
  let [data, setData] = useState(null);

  useEffect(() => {
    fetchData().then(setData);
  }, [fetchData]); // ✅ Effect deps are OK

  // ...
}
```
useCallback 在什么情况下使用？  
在往子组件传入了一个函数并且子组件被 React.memo 缓存了的时候使用，React.memo()是通过校验 props 中的数据是否改变的来决定组件是否需要重新渲染的一种缓存技术。使用 useCallback 和 React.memo，当父组件 state 改变且发生变化的 state 跟子组件无关时，能避免子组件被重新渲染。


## 其他
- React 18 开始，useEffect 在**开发环境且使用了严格模式**会执行两次，执行两次是为了模拟立即卸载组件和重新挂载组件，为了帮助开发者提前发现重新挂载造成的 bug

## 参考文档
- [精读《useEffect 完全指南》](https://zhuanlan.zhihu.com/p/60277120)