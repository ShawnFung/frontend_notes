## Babel-loader

### [Presets](http://babeljs.io/docs/plugins/#presets)

#### Official Presets 正式的Presets
- env
    可以替代 es2015, es2016, es2017 and latest
- react
- flow

#### Stage-X (Experimental Presets) 实验性 Presets
一旦 TC39 会议变更了提案，stage-x presets 也会相应改变，所以使用实验性 Presets，要特别注意。
- Stage 0 - Strawman: 就是一个想法
- Stage 1 - Proposal: 提案，后续可能跟进
- Stage 2 - Draft: 草稿阶段，有初步的说明
- Stage 3 - Candidate: 完成说明文档，并开始浏览器实现
- Stage 4 - Finished: 将在明年发布

### 常见问题
1. vuejs中使用（...）对象扩展运算符报错？  
错误描述：
```
{
  "presets": ["env"]
}

Module build failed: SyntaxError: D:/projects/mars_sky_eye_client1/src/libs/iview_index.js: Unexpected token (49:8)

  47 | function test(){
  48 |     return {
> 49 |         ...a
     |         ^
  50 |     }
  51 | }
  52 | 
```

解决方案：  
    对象扩展运算符，目前仍属于 stage-3，所以需要增加 stage-3 支持。babel-preset-env 不包含实验性的语法。
```
.babelrc
{
  "presets": ["env", "stage-3"]
}
```


### 参考文档：
1. [vuejs中使用（...）对象扩展运算符报错？](https://segmentfault.com/q/1010000008028037)