# SCSS 在 ElementUI 中的应用

## BEM = Block + Element + Modifier
```scss
$namespace: 'el';
$block-separator: '-';
$element-separator: '__';
$modifier-separator: '--';
$state-prefix: 'is-';
```

## 变量命名方式
```scss
/* $--CSS属性-其他  */
$--color-primary: #409EFF;

/* $--Element-CSS属性-其他  */
$--checkbox-font-size: 14px !default;
```


## 参考文档
- [Element 源码学习：SCSS 妙用实现 BEM 命名法](https://www.sdvcrx.com/post/2018-08-20-elementui-bem/)
