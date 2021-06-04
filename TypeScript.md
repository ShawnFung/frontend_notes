# Typescript

## interface 关键字
```typescript
interface IUser {
  name: string;
  age: number;
  findOne(): void;
}
// 函数接口
interface IUserInfoFunc {
  (user: IUser): string;
}
// typescript 推荐使用 type 来定义一个函数的类型
// type IUserInfoFunc = (user: IUser) => string;
const getUserInfo: IUserInfoFunc = (user) => {
  return `name: ${user.name}, age: ${user.age}`;
};
```

### 接口继承
```typescript
interface Shape {     //定义接口Shape
  color: string;
}
interface PenStroke {
  penWidth: number;
}
// 一个 interface 可以同时继承多个 interface ，实现多个接口成员的合并。用逗号隔开要继承的接口。
interface Square extends Shape, PenStroke {  //继承接口Shape
  sideLength: number;
}
```
