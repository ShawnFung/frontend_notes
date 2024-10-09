# Vue3.0

## 基础
- 模板语法
  - 动态绑定多个值，没有参数的 v-bind 会将一个对象的所有属性都作为 attribute 应用到目标元素上。
  - 动态参数
- 计算属性
  - 计算属性值会基于其响应式依赖被缓存，方法调用总是会在重渲染发生时再次执行函数。
- v-if 和 v-for，同时使用 v-if 和 v-for 是不推荐的，因为这样二者的优先级不明显。
  - 当 v-if 和 v-for 同时存在于一个元素上的时候，v-if 会首先被执行。【Vue 3.0】
    ```
    推荐用法：
    <template v-for="todo in todos">
      <li v-if="!todo.isComplete">
        {{ todo.name }}
      </li>
    </template>
    ```
- 侦听器
  - watch()
    - 只追踪明确侦听的数据源，它不会追踪任何在回调中访问到的东西。
    - { immediate: true } 强制侦听器的回调立即执行
    - watch() 与 reactive()
      - 不能直接侦听 reactive() 响应式对象的属性值，需要用一个返回该属性的 getter 函数
      - 直接给 watch() 传入一个 reactive() 响应式对象，会隐式地创建一个深层侦听器——该回调函数在所有嵌套的变更时都会被触发。【开销很大，谨慎使用】
  - watchEffect()
    - 自动跟踪回调的响应式依赖，不需要手动维护。
    - 回调会立即执行，不需要指定 immediate: true
  - 如果想在侦听器回调中能访问被 Vue 更新之后的 DOM
    - 在 watch()、watchEffect() 中增加 { flush: 'post' } 配置
    - watchPostEffect()

## 组件
### 局部注册
- 在使用 ```<script setup>``` 的单文件组件中，导入的组件可以直接在模板中使用，无需注册
- 如果没有使用 ```<script setup>```，则需要使用 components 选项来显式注册

### Props
在使用 ```<script setup>``` 的单文件组件中，props 可以使用 defineProps() 宏来声明。

### 事件
组件可以显式地通过 defineEmits() 宏来声明它要触发的事件，defineEmits() 宏不能在子函数中使用。如上所示，它必须直接放置在 ```<script setup>``` 的顶级作用域下。
```
<script setup>
const emit = defineEmits(['inFocus', 'submit'])

function buttonClick() {
  emit('submit')
}
</script>
```
事件校验
```
<script setup>
const emit = defineEmits({
  // 没有校验
  click: null,

  // 校验 submit 事件
  submit: ({ email, password }) => {
    if (email && password) {
      return true
    } else {
      console.warn('Invalid submit event payload!')
      return false
    }
  }
})
</script>
```

### v-model 其实就是一个语法糖
原生元素
```
<input v-model="searchText" />
相当于：
<input
  :value="searchText"
  @input="searchText = $event.target.value"
/>
```
组件
- 默认使用 modelValue 作为 prop，可以通过给 v-model 指定一个参数来更改名字。
- 可以添加多个 v-model 绑定
- 可以给 v-model 添加自定义的修饰符
```
<CustomInput v-model="searchText" />
相当于：
<CustomInput
  :modelValue="searchText"
  @update:modelValue="newValue => searchText = newValue"
/>
更改名字：
<MyComponent v-model:title="bookTitle" />
```

### 透传 attribute
“透传 attribute”指的是传递给一个组件，却没有被该组件声明为 props 或 emits 的 attribute 或者 v-on 事件监听器。
- 单根节点自动 attribute 透传，如果想要禁用 Attributes 继承，那么需要配置：inheritAttrs: false
- 多根节点没有自动 attribute 透传，如果 $attrs 没有被显式绑定，将会抛出一个运行时警告。
- 在 ```<script setup>``` 中使用 useAttrs() API 来访问一个组件的所有透传 attribute
- 在 setup() 中，使用 ctx.attrs 来访问

### 插槽
- ```<slot>```
- v-slot

### provide 与 inject
provide 可以一个响应式的数据，当提供 / 注入响应式的数据时，建议尽可能将任何对响应式状态的变更都保持在供给方组件中。
```
<!-- 在供给方组件内 -->
<script setup>
import { provide, ref } from 'vue'

const location = ref('North Pole')

function updateLocation() {
  location.value = 'South Pole'
}

provide('location', {
  location,
  updateLocation
})
</script>
```
如果你想确保提供的数据不能被注入方的组件更改，你可以使用 readonly() 来包装提供的值。
```
<script setup>
import { ref, provide, readonly } from 'vue'

const count = ref(0)
provide('read-only-count', readonly(count))
</script>
```

### 组合式函数
利用 Vue 的组合式 API 来封装和复用有状态逻辑的函数。
- 命名：组合式函数约定用驼峰命名法命名，并以“use”作为开头。
- 输入参数：在处理输入参数时，最好兼容 ref 而不只是原始的值。
- 返回值：组合式函数始终返回一个包含多个 ref 的普通的非响应式对象。

### 插件
插件发挥作用的常见场景主要包括以下几种：
- 通过 app.component() 和 app.directive() 注册一到多个全局组件或自定义指令。
- 通过 app.provide() 使一个资源可被注入进整个应用。
- 向 app.config.globalProperties 中添加一些全局实例属性或方法

## API风格
### 选项式 API (Options API)

### 组合式 API (Composition API)
#### ref()
接受一个内部值，返回一个响应式的、可更改的 ref 对象，此对象只有一个指向其内部值的属性 .value
##### 解包
- 当 ref 在模板中作为顶层属性被访问时，它们会被自动解包
- 如果文本插值（{{ }}）计算的最终值是 ref ，也会被自动解包
- 当一个 ref 被嵌套在一个深层响应式对象中，作为属性被访问或更改时，它会自动解包
- 跟响应式对象不同，当 ref 作为响应式数组或像 Map 这种原生集合类型的元素被访问时，不会进行解包。

#### reactive() 转 ref()
- toRef() 基于响应式对象上的一个属性，创建一个对应的 ref。这样创建的 ref 与其源属性保持同步：改变源属性的值将更新 ref 的值，反之亦然。
- toRefs() 
  - 将一个响应式对象转换为一个普通对象，这个普通对象的每个属性都是指向源对象相应属性的 ref。
  - 当从组合式函数中返回响应式对象时，toRefs 相当有用。使用它，消费者组件可以解构/展开返回的对象而不会失去响应性。
  - toRefs 在调用时只会为源对象上可以枚举的属性创建 ref。如果要为可能还不存在的属性创建 ref，请改用 toRef。

#### reactive() 和 ref() 的区别
- ref()可以接受基本类型作为参数（最常见的是：Boolean、String和Number）以及对象，而reactive()只能接受对象作为参数。
- ref 被传递给函数或是从一般对象上被解构时，不会丢失响应性。当我们将 reactive() 返回的响应式对象的属性赋值或解构至本地变量时，或是将该属性传入一个函数时，我们会失去响应性。
- 如果你打算给变量重新赋值，那么一定要用ref。如果你只打算修改引用类型的一个属性，那么推荐用reactive。
- ref 通过 Object.defineProperty() 的 get 与 set 来实现响应式。reactive 通过使用 Proxy 来实现响应式, 并通过 Reflect（反射对象）操作源对象内部的数据。
- 特殊的 ref 属性，声明一个同名的 ref，可以获得该模板的引用。

#### setup() 钩子是在组件中使用组合式 API 的入口
- 在 setup() 函数中返回的对象会暴露给模板和组件实例。
- 在模板中访问从 setup 返回的 ref 时，它会**自动浅层解包**，因此你无须再在模板中为它写 .value。当通过 this 访问时也会同样如此解包。
- setup() 自身并不含对组件实例的访问权，即在 setup() 中访问 this 会是 undefined。
- setup() 的两个参数
  - props，是响应式的
    - 不能直接解构，解构出的变量将会丢失响应性。
    - 如果你确实需要解构 props 对象，或者需要将某个 prop 传到一个外部函数中并保持响应性，那么你可以使用 toRefs() 和 toRef() 这两个工具函数
  - ctx，上下文对象，非响应式的，可以安全地解构
    - ctx.attrs 透传 Attributes（非响应式的对象，等价于 $attrs）
    - ctx.slots 插槽（非响应式的对象，等价于 $slots）
    - ctx.emit 触发事件（函数，等价于 $emit）
    - ctx.expose 暴露公共属性（函数）

## 参考文档
- [Vue官方文档](https://cn.vuejs.org/)