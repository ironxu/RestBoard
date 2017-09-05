import { Message } from 'element-ui';
// 错误信息提示
var errorMsg = function(msg) {
  Message({
    showClose: true,
    message: msg,
    type: 'error',
    duration: 3000
  })
}
// 成功信息提示
var successMsg = function($msg) {
  $msg = $msg || '添加成功'
  Message({
    type: 'success',
    message: $msg
  })
}
export default {
    baseUrl:'http://rb.local.com',
    // baseUrl:'http://rb.ironxu.com',
    errorMsg,
    successMsg,
    appId: 4
}