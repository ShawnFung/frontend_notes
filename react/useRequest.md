# useRequest

## 手动调用
```tsx
const { loading, run, runAsync } = useRequest(service, {
  manual: true
});
```

## 参数管理
```ts
const { run: register } = useRequest(
  async values => {
    const { username, password } = values
    const data = await registerService(username, password)
    return data
  },
  { manual: true }
)
const onFinish = (values: any) => {
  register(values)
}
```