/**
 * 深拷贝
 * @param {} obj 
 * @returns 
 */
function deepClone(obj = {}){
  // 非引用类型直接返回
  if(typeof obj !== "object" || obj == null){
      return obj;
  }
  
  // 判断是数组还是对象
  let result = obj instanceof Array ? [] : {};
  
  // 遍历拷贝对象本身的属性
  for(let key in obj){
    if(obj.hasOwnProperty(key)){
      result[key] = deepClone(obj[key]);
    }
  }
  
  return result;
}