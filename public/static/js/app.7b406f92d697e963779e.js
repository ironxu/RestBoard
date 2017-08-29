webpackJsonp([1],Array(25).concat([function(e,t,r){"use strict";var o=r(2),n=r(100),a=r(99),s=r(16),i=r.n(s),l=r(76),u=(r.n(l),r(78)),c=(r.n(u),r(77)),m=(r.n(c),r(89)),d=r.n(m),p=r(86),v=r.n(p),f=r(87),h=r.n(f),g=r(88),b=r.n(g),_=r(90),F=r.n(_),E=r(56);o.default.use(n.a),o.default.use(a.a),o.default.use(i.a),o.default.prototype.$common=E.a,t.a=new n.a({routes:[{path:"/",component:h.a},{path:"/home",component:d.a},{path:"/app",component:h.a},{path:"/api",component:v.a},{path:"/doc",component:b.a},{path:"/request",component:F.a}]})},function(e,t,r){function o(e){r(81)}var n=r(4)(r(49),r(94),o,"data-v-25441132",null);e.exports=n.exports},,,,,,,,,,,,,,,,,,,,,,,function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={data:function(){return{activeIndex:"home"}},methods:{handleSelect:function(e,t){console.log(e,t)}}}},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={}},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=r(91),n=r.n(o),a=1e3;t.default={components:{"add-category":n.a},data:function(){return{lists:[],isInputEmpty:!1,dialogFormVisible:!1,dialogEnvFormVisible:!1,currentAppID:0,currentEnvId:0,ruleForm:{name:"",description:"",remark:""},rules:{name:[{required:!0,message:"请输入名称",trigger:"blur"},{min:1,max:50,message:"长度在 1 到 50 个字符",trigger:"blur"}],description:[{required:!0,message:"请输入描述信息",trigger:"blur"},{min:1,max:200,message:"长度在 1 到 200 个字符",trigger:"blur"}]},detailInfo:{},envTableData:[],EnvRules:{name:[{required:!0,message:"请输入名称",trigger:"blur"},{min:1,max:50,message:"长度在 1 到 50 个字符",trigger:"blur"}],url:[{required:!0,message:"请输入url",trigger:"blur"},{min:1,max:200,message:"长度在 1 到 200 个字符",trigger:"blur"}],host:[{required:!0,message:"请输入url",trigger:"blur"},{min:1,max:100,message:"长度在 1 到 200 个字符",trigger:"blur"}]},ruleEnvForm:{name:"",url:"",host:"",color:"#fff",remark:""},categoryMenuData:[],defaultProps:{children:"children",label:"label"}}},created:function(){this.getAppLists()},methods:{getAppLists:function(){var e=this.$common.baseUrl+"/apps";this.$http.get(e).then(function(e){if(200!==e.status)return this.$common.errorMsg(e.status),!1;var t=e.body||[];this.httpStatus=e.status,this.lists=t,t[0]&&this.switchInfo(t[0].id)})},submitAppForm:function(e){var t=this;this.$refs[e].validate(function(e){if(!e)return t.$common.errorMsg("提交APP信息失败"),!1;t.dialogFormVisible=!1,t.addAppData()})},resetAppForm:function(e){this.$refs[e].resetFields()},addAppData:function(){var e=this.$common.baseUrl+"/apps";this.$http.post(e,{name:this.ruleForm.name,description:this.ruleForm.description,remark:this.ruleForm.remark},{emulateJSON:!0}).then(function(e){200===e.status&&e.body.id?(this.$common.successMsg("APP添加成功"),this.getAppLists()):this.$common.errorMsg(e.status)}),this.resetAppFrom()},switchInfo:function(e){this.currentAppID=e;var t=this.$common.baseUrl+"/apps/"+e;this.$http.get(t).then(function(t){200===t.status?(this.detailInfo=t.body,this.getEnvData(e),this.getCategoryMenuData(e)):this.$common.errorMsg(t.status)})},getEnvData:function(e){var t=this.$common.baseUrl+"/envs/app/"+e;this.$http.get(t).then(function(e){200===e.status?this.envTableData=e.body:this.$common.errorMsg(e.status)},function(e){this.envTableData=[],this.$common.errorMsg(e.status)})},resetEnvForm:function(e){this.$refs[e].resetFields()},submitEnvForm:function(e){var t=this;this.$refs[e].validate(function(e){if(!e)return t.$common.errorMsg("提交环境配置失败"),!1;t.dialogEnvFormVisible=!1,t.addEnvData()})},addEnvData:function(){var e=this.$common.baseUrl+"/envs";this.$http.post(e,{name:this.ruleEnvForm.name,app_id:this.currentAppID,url:this.ruleEnvForm.url,remark:this.ruleEnvForm.remark,host:this.ruleEnvForm.host,color:this.ruleEnvForm.color},{emulateJSON:!0}).then(function(e){if(200===e.status&&e.body.id)return this.$common.successMsg("添加环境配置成功"),this.getEnvData(this.currentAppID),!1;this.$common.errorMsg(e.status)}),this.resetEnvForm()},deleteAppData:function(e){var t=this.$common.baseUrl+"/apps/"+e;this.$http.delete(t).then(function(e){if(200===e.status&&e.body.id)return this.$common.successMsg("删除APP数据成功"),this.getAppLists(),!1;this.$common.errorMsg(e.status)})},submitEditAppForm:function(e,t){var r=this;this.$refs[e].validate(function(e){if(e)return r.dialogFormVisible=!1,r.addEditAppData(t),!0;r.$common.errorMsg("提交修改的APP信息失败")})},addEditAppData:function(e){var t=this.$common.baseUrl+"/apps/"+e;this.$http.put(t,{name:this.detailInfo.name,description:this.detailInfo.description,remark:this.detailInfo.remark},{emulateJSON:!0}).then(function(e){if(200===e.status&&e.body.id)return this.$common.successMsg("修改APP信息成功"),this.getAppLists(),!0;this.$common.errorMsg(e.status)})},handleEnvDelete:function(e,t){var r=this.$common.baseUrl+"/envs/"+t;this.$http.delete(r).then(function(e){if(200===e.status&&e.body.id)return this.$common.successMsg("删除环境信息成功"),void this.getEnvData(this.currentAppID);this.$common.errorMsg(e.status)})},submitEditEnvForm:function(e,t){var r=this;this.$refs[e].validate(function(e){if(e)return r.dialogEnvFormVisible=!1,void r.addEditEnvData(t);r.$common.errorMsg("提交修改的环境信息失败")})},addEditEnvData:function(e){var t=this.$common.baseUrl+"/envs/"+e;this.$http.put(t,{name:this.ruleEnvForm.name,app_id:this.currentAppID,url:this.ruleEnvForm.url,remark:this.ruleEnvForm.remark,host:this.ruleEnvForm.host,color:this.ruleEnvForm.color},{emulateJSON:!0}).then(function(e){if(200===e.status&&e.body.id)return this.$common.successMsg("添加修改的环境信息成功"),void this.getEnvData(this.currentAppID);this.$common.errorMsg(e.status)})},startEditEnvData:function(e){for(var t in e)this.ruleEnvForm[t]=e[t];this.dialogEnvFormVisible=!0},getCategoryMenuData:function(e){var t=this.$common.baseUrl+"/categories/app/"+e+"?type=tree";console.log(t),this.$http.get(t).then(function(e){if(200!==e.status)return this.$common.errorMsg(e.status),this.categoryMenuData=[],!1;this.categoryMenuData=e.body,console.log(this.categoryMenuData)},function(e){this.$common.errorMsg(e.status),this.categoryMenuData=[]})},append:function(e,t){e.append({id:a++,label:"test",children:[]},t)},remove:function(e,t){e.remove(t)},renderContent:function(e,t){var r=this,o=t.node,n=t.data,a=t.store;return e("span",null,[e("span",null,[e("span",null,[o.label])]),e("span",{style:"float: right; margin-right: 20px"},[e("el-button-group",null,[e("el-button",{attrs:{size:"small",plain:!0,icon:"edit",type:"info"},on:{click:function(){return r.append(a,n)}}},["edit"]),e("el-button",{attrs:{size:"small",icon:"delete",type:"danger"},on:{click:function(){return r.remove(a,n)}}},["Delete"])])])])}}}},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={}},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={data:function(){return{msg:"home"}}}},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={}},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={data:function(){return{isShow:!1,categoryTitle:"添加分类信息",categoryForm:{name:"",sort:0,remark:""},categoryRules:{name:[{required:!0,message:"请输入名称",trigger:"blur"},{min:1,max:50,message:"长度在 1 到 50 个字符",trigger:"blur"}]},options:[]}},props:["appId"],created:function(){this.getCascader()},methods:{addCategory:function(){this.categoryTitle="添加分类信息",this.isShow=!0},getCascader:function(){var e=this.$common.baseUrl+"/categories/app/4?type=cascader";this.$http.get(e).then(function(e){if(200!==e.status)return void this.$common.errorMsg(e.status);this.options=e.body})},handleChange:function(){},resetCategoryForm:function(e){console.log(this.$refs[e]),this.isShow=!1},submitEditCategoryForm:function(e,t){var r=this,o=0;this.$refs[e].validate(function(t){if(!t)return r.$common.errorMsg("提交环境配置失败"),!1;if("添加分类信息"==r.categoryTitle){console.log(r.categoryForm);var n=r.categoryForm.pid;n&&0!==n.length&&(o=n[n.length-1]);var a=r.$common.baseUrl+"/categories";console.log(r.categoryForm),r.$http.post(a,{app_id:r.appId,name:r.categoryForm.name,pid:o,sort:r.categoryForm.sort,remark:r.categoryForm.remark},{emulateJSON:!0}).then(function(e){if(200!==e.status)return this.$common.errorMsg(e.status),!1;this.$common.successMsg("添加分类信息成功")})}location.reload(),r.resetCategoryForm(e)})}}}},function(e,t,r){"use strict";var o=r(16),n=(r.n(o),function(e){r.i(o.Message)({showClose:!0,message:e,type:"error",duration:3e3})}),a=function(e){e=e||"添加成功",r.i(o.Message)({type:"success",message:e})};t.a={baseUrl:"http://rb.local.com",errorMsg:n,successMsg:a}},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=r(2),n=r(26),a=r.n(n),s=r(25);o.default.config.productionTip=!1,new o.default({el:"#app",router:s.a,template:"<App/>",components:{App:a.a}})},,,,,,,,,,,,,,,,,,,function(e,t){},function(e,t){},function(e,t){},function(e,t){},function(e,t){},function(e,t){},function(e,t){},function(e,t){},function(e,t){},function(e,t){},function(e,t,r){function o(e){r(84)}var n=r(4)(r(50),r(97),o,"data-v-cffeeb94",null);e.exports=n.exports},function(e,t,r){function o(e){r(83)}var n=r(4)(r(51),r(96),o,"data-v-b37b9078",null);e.exports=n.exports},function(e,t,r){function o(e){r(85)}var n=r(4)(r(52),r(98),o,"data-v-f518391c",null);e.exports=n.exports},function(e,t,r){function o(e){r(82)}var n=r(4)(r(53),r(95),o,"data-v-2c2085c4",null);e.exports=n.exports},function(e,t,r){function o(e){r(79)}var n=r(4)(r(54),r(92),o,"data-v-0343aac0",null);e.exports=n.exports},function(e,t,r){function o(e){r(80)}var n=r(4)(r(55),r(93),o,"data-v-229bdbd6",null);e.exports=n.exports},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement;return(e._self._c||t)("div",[e._v("\n    request\n")])},staticRenderFns:[]}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("div",{staticClass:"app-name-header"},[e._v("分类信息")]),e._v(" "),r("el-button",{attrs:{icon:"plus",size:"small"},on:{click:e.addCategory}},[e._v("添加分类")]),e._v(" "),r("el-dialog",{attrs:{title:e.categoryTitle,visible:e.isShow},on:{"update:visible":function(t){e.isShow=t}}},[r("el-form",{ref:"categoryForm",staticClass:"demo-ruleForm",attrs:{model:e.categoryForm,rules:e.categoryRules,"label-width":"100px"}},[r("el-form-item",{attrs:{label:"名称",prop:"name"}},[r("el-input",{model:{value:e.categoryForm.name,callback:function(t){e.categoryForm.name="string"==typeof t?t.trim():t},expression:"categoryForm.name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"上级"}},[r("el-cascader",{attrs:{options:e.options},on:{change:e.handleChange},model:{value:e.categoryForm.pid,callback:function(t){e.categoryForm.pid=t},expression:"categoryForm.pid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"排序",prop:"sort"}},[r("el-input",{model:{value:e.categoryForm.sort,callback:function(t){e.categoryForm.sort=e._n(t)},expression:"categoryForm.sort"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"备注"}},[r("el-input",{model:{value:e.categoryForm.remark,callback:function(t){e.categoryForm.remark=t},expression:"categoryForm.remark"}})],1),e._v(" "),r("el-form-item",[r("el-button",{on:{click:function(t){e.resetCategoryForm("categoryForm")}}},[e._v("重置")]),e._v(" "),r("el-button",{attrs:{type:"primary"},on:{click:function(t){e.submitEditCategoryForm("categoryForm",e.categoryForm.id)}}},[e._v("保存")])],1)],1)],1)],1)},staticRenderFns:[]}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-menu",{staticClass:"el-menu-demo",attrs:{theme:"dark","default-active":e.activeIndex,mode:"horizontal",router:!0},on:{select:e.handleSelect}},[r("el-menu-item",{attrs:{index:"home"}},[e._v("RestBoard")]),e._v(" "),r("el-menu-item",{attrs:{index:"app"}},[e._v("\n\t    App\n\t  ")]),e._v(" "),r("el-menu-item",{attrs:{index:"api"}},[e._v("Api")]),e._v(" "),r("el-menu-item",{attrs:{index:"request"}},[e._v("Request")]),e._v(" "),r("el-menu-item",{attrs:{index:"doc"}},[e._v("Doc")])],1),e._v(" "),r("router-view")],1)},staticRenderFns:[]}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement;return(e._self._c||t)("div",[e._v("\n  "+e._s(e.msg)+"\n")])},staticRenderFns:[]}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-row",{attrs:{type:"flex"}},[r("el-col",{attrs:{span:4}},[r("div",{staticClass:"grid-content bg-purple"},[r("el-menu",{staticClass:"el-menu-demo",attrs:{"default-active":"2"}},e._l(e.lists,function(t,o){return r("el-menu-item",e._b({key:o,on:{click:function(r){e.switchInfo(t.id)}}},"el-menu-item",{index:"index"+o},!1),[e._v(e._s(t.name))])})),e._v(" "),r("el-button",{staticClass:"addAppDataButton",on:{click:function(t){e.dialogFormVisible=!0}}},[e._v("添加APP")]),e._v(" "),r("el-dialog",{attrs:{title:"添加APP",visible:e.dialogFormVisible},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[r("el-form",{ref:"ruleForm",staticClass:"demo-ruleForm",attrs:{model:e.ruleForm,rules:e.rules,"label-width":"100px"}},[r("el-form-item",{attrs:{label:"名称",prop:"name"}},[r("el-input",{model:{value:e.ruleForm.name,callback:function(t){e.ruleForm.name=t},expression:"ruleForm.name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"描述",prop:"description"}},[r("el-input",{model:{value:e.ruleForm.description,callback:function(t){e.ruleForm.description=t},expression:"ruleForm.description"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"备注"}},[r("el-input",{model:{value:e.ruleForm.remark,callback:function(t){e.ruleForm.remark=t},expression:"ruleForm.remark"}})],1),e._v(" "),r("el-form-item",[r("el-button",{on:{click:function(t){e.resetAppFrom("ruleForm")}}},[e._v("重置")]),e._v(" "),r("el-button",{attrs:{type:"primary"},on:{click:function(t){e.submitAppForm("ruleForm")}}},[e._v("提交")])],1)],1)],1)],1)]),e._v(" "),r("el-col",{staticClass:"mainContent",attrs:{span:20}},[r("div",{staticClass:"grid-content bg-purple-light"},[0===e.lists.length?r("el-alert",{attrs:{title:"内容为空，请点击左侧的添加APP按钮",type:"info"}}):e._e(),e._v(" "),r("div",{staticClass:"app-detail"},[r("div",{staticClass:"app-info"},[r("div",{staticClass:"app-name"},[r("div",{staticClass:"app-name-header"},[e._v(e._s(e.detailInfo.name))]),e._v(" "),r("el-button-group",[r("el-button",{attrs:{icon:"edit",size:"small"},on:{click:function(t){e.dialogFormVisible=!0}}},[e._v("编辑")]),e._v(" "),r("el-dialog",{attrs:{title:"编辑APP",visible:e.dialogFormVisible},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[r("el-form",{ref:"detailInfo",staticClass:"demo-ruleForm",attrs:{model:e.detailInfo,rules:e.rules,"label-width":"100px"}},[r("el-form-item",{attrs:{label:"名称",prop:"name"}},[r("el-input",{model:{value:e.detailInfo.name,callback:function(t){e.detailInfo.name=t},expression:"detailInfo.name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"描述",prop:"description"}},[r("el-input",{model:{value:e.detailInfo.description,callback:function(t){e.detailInfo.description=t},expression:"detailInfo.description"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"备注"}},[r("el-input",{model:{value:e.detailInfo.remark,callback:function(t){e.detailInfo.remark=t},expression:"detailInfo.remark"}})],1),e._v(" "),r("el-form-item",[r("el-button",{attrs:{type:"primary"},on:{click:function(t){e.submitEditAppForm("detailInfo",e.detailInfo.id)}}},[e._v("保存")])],1)],1)],1),e._v(" "),r("el-button",{attrs:{icon:"delete",size:"small",type:"danger"},on:{click:function(t){e.deleteAppData(e.detailInfo.id)}}},[e._v("删除")])],1)],1),e._v(" "),r("div",{staticClass:"app-desc"},[r("div",{staticClass:"app-name-header"},[e._v("APP 描述")]),e._v(" "),r("div",{staticClass:"app-remark-detail"},[e._v(e._s(e.detailInfo.description))])]),e._v(" "),""!==e.detailInfo.remark?r("div",{staticClass:"app-remark"},[r("div",{staticClass:"app-name-header"},[e._v("备注信息")]),e._v(" "),r("div",{staticClass:"app-remark-detail"},[e._v(e._s(e.detailInfo.remark))])]):e._e(),e._v(" "),r("div",{staticClass:"app-created"},[r("div",{staticClass:"app-name-header"},[e._v("创建时间")]),e._v(" "),r("div",{staticClass:"app-remark-detail"},[e._v(e._s(e.detailInfo.created_at))])])]),e._v(" "),r("div",{staticClass:"divider"}),e._v(" "),r("div",{staticClass:"app-env"},[r("div",[r("div",{staticClass:"app-env-header"},[r("div",{staticClass:"app-name-header"},[e._v("环境信息")]),e._v(" "),r("el-button",{attrs:{icon:"plus",size:"small"},on:{click:function(t){e.dialogEnvFormVisible=!0}}},[e._v("添加环境")]),e._v(" "),r("el-dialog",{attrs:{title:"添加环境配置",visible:e.dialogEnvFormVisible},on:{"update:visible":function(t){e.dialogEnvFormVisible=t}}},[r("el-form",{ref:"ruleEnvForm",staticClass:"demo-ruleForm",attrs:{model:e.ruleEnvForm,rules:e.EnvRules,"label-width":"100px"}},[r("el-form-item",{attrs:{label:"名称",prop:"name"}},[r("el-input",{model:{value:e.ruleEnvForm.name,callback:function(t){e.ruleEnvForm.name=t},expression:"ruleEnvForm.name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"Url",prop:"url"}},[r("el-input",{model:{value:e.ruleEnvForm.url,callback:function(t){e.ruleEnvForm.url=t},expression:"ruleEnvForm.url"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"host",prop:"host"}},[r("el-input",{model:{value:e.ruleEnvForm.host,callback:function(t){e.ruleEnvForm.host=t},expression:"ruleEnvForm.host"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"颜色"}},[r("div",{staticClass:"block"},[r("el-color-picker",{model:{value:e.ruleEnvForm.color,callback:function(t){e.ruleEnvForm.color=t},expression:"ruleEnvForm.color"}})],1)]),e._v(" "),r("el-form-item",{attrs:{label:"备注"}},[r("el-input",{model:{value:e.ruleEnvForm.remark,callback:function(t){e.ruleEnvForm.remark=t},expression:"ruleEnvForm.remark"}})],1),e._v(" "),r("el-form-item",[r("el-button",{on:{click:function(t){e.resetEnvForm("ruleEnvForm")}}},[e._v("重置")]),e._v(" "),r("el-button",{attrs:{type:"primary"},on:{click:function(t){e.submitEnvForm("ruleEnvForm")}}},[e._v("提交")])],1)],1)],1)],1),e._v(" "),[r("el-table",{staticStyle:{width:"95%"},attrs:{data:e.envTableData,border:"",fit:"",stripe:""}},[r("el-table-column",{attrs:{label:"名称",width:"150"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("span",[e._v(e._s(t.row.name))])]}}])}),e._v(" "),r("el-table-column",{attrs:{label:"Url","min-width":"200"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("span",[e._v(e._s(t.row.url))])]}}])}),e._v(" "),r("el-table-column",{attrs:{label:"Host","min-width":"200"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("span",[e._v(e._s(t.row.host))])]}}])}),e._v(" "),r("el-table-column",{attrs:{label:"颜色",width:"70",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("div",{staticClass:"block"},[r("div",{staticClass:"app-show-color",style:{"background-color":e.row.color}})])]}}])}),e._v(" "),r("el-table-column",{attrs:{label:"备注",width:"150"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("span",[e._v(e._s(t.row.remark))])]}}])}),e._v(" "),r("el-table-column",{attrs:{label:"操作",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-button-group",[r("el-button",{attrs:{icon:"edit",size:"small"},on:{click:function(r){e.startEditEnvData(t.row)}}},[e._v("编辑")]),e._v(" "),r("el-button",{attrs:{icon:"delete",size:"small",type:"danger"},on:{click:function(r){e.handleEnvDelete(t.$index,e.ruleEnvForm.id)}}},[e._v("删除")])],1)]}}])})],1),e._v(" "),r("el-dialog",{attrs:{title:"编辑环境配置",visible:e.dialogEnvFormVisible},on:{"update:visible":function(t){e.dialogEnvFormVisible=t}}},[r("el-form",{ref:"ruleEnvForm",staticClass:"demo-ruleForm",attrs:{model:e.ruleEnvForm,rules:e.EnvRules,"label-width":"100px"}},[r("el-form-item",{attrs:{label:"名称",prop:"name"}},[r("el-input",{model:{value:e.ruleEnvForm.name,callback:function(t){e.ruleEnvForm.name=t},expression:"ruleEnvForm.name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"Url",prop:"url"}},[r("el-input",{model:{value:e.ruleEnvForm.url,callback:function(t){e.ruleEnvForm.url=t},expression:"ruleEnvForm.url"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"host",prop:"host"}},[r("el-input",{model:{value:e.ruleEnvForm.host,callback:function(t){e.ruleEnvForm.host=t},expression:"ruleEnvForm.host"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"颜色"}},[r("div",{staticClass:"block"},[r("el-color-picker",{model:{value:e.ruleEnvForm.color,callback:function(t){e.ruleEnvForm.color=t},expression:"ruleEnvForm.color"}})],1)]),e._v(" "),r("el-form-item",{attrs:{label:"备注"}},[r("el-input",{model:{value:e.ruleEnvForm.remark,callback:function(t){e.ruleEnvForm.remark=t},expression:"ruleEnvForm.remark"}})],1),e._v(" "),r("el-form-item",[r("el-button",{on:{click:function(t){e.resetEnvForm("ruleEnvForm")}}},[e._v("重置")]),e._v(" "),r("el-button",{attrs:{type:"primary"},on:{click:function(t){e.submitEditEnvForm("ruleEnvForm",e.ruleEnvForm.id)}}},[e._v("保存")])],1)],1)],1)]],2)]),e._v(" "),r("div",{staticClass:"divider"}),e._v(" "),r("div",{staticClass:"app-category"},[r("div",{staticClass:"app-category-header"},[r("add-category",{attrs:{appId:e.currentAppID}})],1),e._v(" "),r("el-row",[r("el-col",{attrs:{span:10}},[r("el-tree",{attrs:{data:e.categoryMenuData,props:e.defaultProps,"node-key":"id","default-expand-all":"","expand-on-click-node":!1,"render-content":e.renderContent}})],1)],1)],1)])],1)])],1)],1)},staticRenderFns:[]}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-row",[r("el-col",{attrs:{span:4}},[r("div",{staticClass:"grid-content bg-purple"})]),e._v(" "),r("el-col",{staticClass:"mainContent",attrs:{span:20}},[r("div",{staticClass:"grid-content bg-purple-light"})])],1)],1)},staticRenderFns:[]}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement;return(e._self._c||t)("div",[e._v("\n    doc\n")])},staticRenderFns:[]}},,,,,function(e,t){}]),[57]);
//# sourceMappingURL=app.7b406f92d697e963779e.js.map