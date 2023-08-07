# antd 源码解析

## Button
- createRef 与 useRef：
  - createRef 仅能用在 ClassComponent
  - useRef 仅能用在 FunctionComponent
- forwardRef：转发 Ref，它会创建一个 React 组件，这个组件能够将其接受的 ref 属性转发到其组件树下的另一个组件中。其主要作用是：
  - 转发 refs 到 DOM 组件（ref不像 props 作为参数可以传递，所以要想传递 ref 得用 forwardRef）
  ```tsx
  const FancyButton = React.forwardRef((props, ref) => (
    <button ref={ref} className="FancyButton">
      {props.children}
    </button>
  ));

  // You can now get a ref directly to the DOM button:
  const ref = useRef(null)
  <FancyButton ref={ref}>Click me!</FancyButton>;
  ```
  - 和 useImperativeHandle 一起使用，可以让你在使用 ref 时自定义暴露给父组件的实例值，实现父组件调子组件的属性和方法。
  ```tsx
  interface SelectFileModalRef {
    handleShowModal: () => void;
    handleCancel: () => void;
  }
  const SelectFileModal = forwardRef<SelectFileModalRef, Props>(
    (props: Props, ref: Ref<SelectFileModalRef>) => {
      useImperativeHandle(ref, () => ({
        handleShowModal,
        handleCancel,
      }));
    
    }
  );
  ```
  - 在高阶组件中转发 refs
- 空值合并操作符 (`??`)、逻辑或操作符（`||`）、可选链操作符(`?.`)
  - 空值合并操作符（`??`）是一个逻辑操作符，当左侧的操作数为 null 或者 undefined 时，返回其右侧操作数，否则返回左侧操作数。
  - 逻辑或操作符（`||`）会在左侧操作数为**假值**时返回右侧操作数。比如为假值（例如，'' 或 0）时。
  - 可选链操作符(`?.`)允许读取位于连接对象链深处的属性的值，而不必明确验证链中的每个引用是否有效。引用为空(null 或者 undefined) 的情况下不会引起错误。
- rc-util
  - useMergedState：通过该 Hook 你可以自由定义表单控件的受控和非受控状态。
  - composeRef
- Typescript
  - Omit：以一个类型为基础支持剔除某些属性，然后返回一个新类型。

## Form
- 通过 useContext 将 disabled、size 配置属性传递给子组件。

## 参考文档
- [forwardRef和useImperativeHandle的使用](https://juejin.cn/post/6968664212348338206)
- [useImperativeHandle官方文档](https://react.dev/reference/react/useImperativeHandle)
- [我们应该如何优雅的处理 React 中受控与非受控](https://juejin.cn/post/7178485530223444026)