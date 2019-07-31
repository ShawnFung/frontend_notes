# SCSS

## 语法
- $ 定义变量，例如 $color
- 插值语句 #{}，通过 #{} 插值语句可以在选择器或属性名中使用变量
- & 父选择器
- @at-root 指令可以将一个或多个样式规则生成在样式文件根层级上，而不是嵌套在其父选择器中

## mixin
- @mixin 定义混合指令
- @include 引用混合指令
- @content 将外部的 Content Block 传递到 Mixin 内部去
```scss
@mixin b($block) {
  $B: $namespace+'-'+$block !global;

  .#{$B} {
    @content;
  }
}
@include b(button) {
  display: inline-block;
}
```
