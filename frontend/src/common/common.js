import { Message } from 'element-ui';
// 错误信息提示
var errorMsg = function(msg) {
  this.$message({
    showClose: true,
    message: msg,
    type: 'error',
    duration: 3000
  })
}
// 成功信息提示
var successMsg = function($msg) {
  $msg = $msg || '添加成功'
  this.$message({
    type: 'success',
    message: $msg
  })
}
export default {
    baseUrl:'http://rb.local.com',
    errorMsg,
    successMsg
}