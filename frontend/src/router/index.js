import Vue from 'vue'

import Router from 'vue-router'
Vue.use(Router)
// 导入vue-resource
import resource from 'vue-resource'
Vue.use(resource)
// 导入elment-ui
import elementUi from 'element-ui'
// 完整引入
Vue.use(elementUi)
import 'element-ui/lib/theme-default/index.css'
// iview完整引入
import iView from 'iview';
import 'iview/dist/styles/iview.css';    // 使用 CSS
Vue.use(iView);


// 全局样式
import '../../static/css/site.css'
//css重置
// import 'normalize.css'
import home from '@/components/home'
import apiList from '../components/api/apiList.vue'
import apiDetail from  '../components/api/apiDetail.vue'
import app from '../components/app/app.vue'
import doc from '../components/doc/doc.vue'
import request from '../components/request/request.vue'

import common from '../common/common.js'
Vue.prototype.$common = common
export default new Router({
  routes: [{
    path: '/',
    component: app
  }, {
    path: '/home',
    component: home
  },
  {
    path: '/app',
    component: app
  }, {
    path: '/api/list/:app_id/:cate_id',
    component: apiList
  },{
    path: '/api/detail/:app_id/:cate_id/:api_id',
    component: apiDetail
  }, {
    path: '/doc',
    component: doc
  }, {
    path: '/request/:app_id/:cate_id/:api_id',
    component: request
  }
  ]
})
