/**
 * 跟 DOM 相关的功能函数
 */


/**
 * 获取元素样式
 * @param elem
 * @param property
 * @returns {string}
 */
function getStyle(elem, property) {
  // ie通过currentStyle来获取元素的样式，其他浏览器通过getComputedStyle来获取
  return document.defaultView.getComputedStyle ? document.defaultView.getComputedStyle(elem, false)[property] : elem.currentStyle[property];
}

/**
 * 获取当前浏览器支持的transform兼容写法。如果返回的为空字符串，则表示当前浏览器并不支持transform
 * @returns {string}
 */
function getTransform() {
  var transform = '';
  var divStyle = document.createElement('div').style;
    // 可能涉及到的几种兼容性写法，通过循环找出浏览器识别的那一个
  var transformArr = ['transform', 'webkitTransform', 'MozTransform', 'msTransform', 'OTransform'];

  for(let i = 0, len = transformArr.length; i < len; i++)  {
    if(transformArr[i] in divStyle) {
      // 找到之后立即返回，结束函数
      return transform = transformArr[i];
    }
  }

  // 如果没有找到，就直接返回空字符串
  return transform;
}






