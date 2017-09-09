<template>
  <div>
    <el-row>
      <el-col :span="4">
        <div class="grid-content bg-purple">
            <el-menu class="el-menu-demo" :default-active="activeIndex">
                <el-menu-item v-bind="{index:item.id + ''}" v-for="(item,i) in lists" :key="i" @click="sendApiInfo(item.name, item.id)">{{item.name}}</el-menu-item>
            </el-menu>
        </div>
      </el-col>

      <el-col :span="19" class="mainContent">
        <div class="grid-content bg-purple-light">
            <el-breadcrumb separator="/">
                  <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                  <el-breadcrumb-item>{{apiTitle}}</el-breadcrumb-item>
                  <!-- <el-breadcrumb-item>{{}}</el-breadcrumb-item> -->
            </el-breadcrumb>
            <el-button-group>
              <el-button size="small" icon="more" @click="enterRequest">请求</el-button>
              <el-button size="small" icon="plus"  @click="addApi">添加</el-button>
              <el-button size="small" icon="delete" @click="deleteApiData">删除</el-button>
            </el-button-group>
        </div>
        <div>
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
              <h3><el-form-item label="基本信息"></el-form-item></h3>
              <el-form-item label="名称" prop="name">
                <el-input v-model="ruleForm.name"></el-input>
              </el-form-item>
              <el-form-item label="描述" prop="description">
                <el-input v-model="ruleForm.description"></el-input>
              </el-form-item>
              <h3><el-form-item label="请求"></el-form-item></h3>
              <el-row>
                <el-col :span="5" prop="method">
                  <el-form-item label="URL" prop="method" > 
                    <el-select v-model="ruleForm.method" placeholder="method">
                      <el-option label="GET" value="GET"></el-option>
                      <el-option label="POST" value="POST"></el-option>
                      <el-option label="PUT" value="PUT"></el-option>
                      <el-option label="DELETE" value="DELETE"></el-option>
                      <el-option label="HEAD" value="HEAD"></el-option>
                      <el-option label="OPTIONS" value="OPTIONS"></el-option>
                    </el-select>
                  </el-form-item>
                </el-col>
                <el-col :span="19" >
                  <el-form-item label-width="0" prop="uri"> 
                    <el-input v-model="ruleForm.uri"></el-input>
                  </el-form-item>
                </el-col>
              </el-row>
              <el-form-item label="请求头" prop="req_header">
                <el-input type="textarea" :minRows=1 :maxRows=8 :autosize="true" v-model="ruleForm.req_header"></el-input>
              </el-form-item>
              <el-form-item label="请求体" prop="req_body">
                <el-input type="textarea" :minRows=1 :maxRows=8 :autosize="true" v-model="ruleForm.req_body"></el-input>
              </el-form-item>
              <h3><el-form-item label="响应"></el-form-item></h3>
              <el-form-item label="响应头" prop="resp_header">
                <el-input type="textarea" :minRows=1 :maxRows=8 :autosize="true" v-model="ruleForm.resp_header"></el-input>
              </el-form-item>
              <el-form-item label="响应体" prop="resp_body">
                <template>
                  <el-tabs v-model="activeName">
                    <el-tab-pane label="raw" name="raw">
                      <el-input type="textarea" :minRows=1 :maxRows=8 :autosize="true" v-model="ruleForm.resp_body"></el-input>
                    </el-tab-pane>
                    <el-tab-pane label="json" name="json">
                      <el-input type="textarea" :minRows=1 :maxRows=8 :autosize="true" v-model="ruleForm.resp_body_json" readonly></el-input>
                    </el-tab-pane>
                  </el-tabs>
                </template>
              </el-form-item>
              <el-form-item label="备注" prop="remark">
                <el-input v-model="ruleForm.remark"></el-input>
              </el-form-item>

              <el-form-item>
                <el-button size="small" type="primary" @click="submitForm('ruleForm')">保存</el-button>
                <el-button size="small" @click="resetForm('ruleForm')">重置</el-button>
              </el-form-item>
            </el-form>
          </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'api-detail',
  data () {
    return {
      cateId: 0,
      // 该分类下的所有api
      apiTitle: '',
      apiId: 0,
      lists: [],
      activeName: 'raw',
      activeIndex: '0',
      ruleForm: {
          app_id: 0,
          cate_id: 0,
          name: '',
          description: '',
          method: 'GET',
          uri: '',
          req_header: '',
          req_body: '',
          resp_header: '',
          resp_body: '',
          remark: ''
      },
      rules: {
        name: [
          { required: true, message: '请输入名称', trigger: 'blur' },
          { min: 3, max: 50, message: '长度在 3 到 50 个字符', trigger: 'blur' }
        ],
        description: [
          { required: true, message: '请输入描述', trigger: 'blur' },
          { min: 3, max: 200, message: '长度在 3 到 50 个字符', trigger: 'blur' }
        ],
        method: [
          { required: true, message: '请输入请求方法', trigger: 'blur' },
          { min: 2, max: 7, message: '长度在 2 到 7 个字符', trigger: 'blur' }
        ],
        uri: [
          { required: true, message: '请输入URI', trigger: 'blur' },
          { min: 3, max: 200, message: '长度在 3 到 200 个字符', trigger: 'blur' }
        ]
      }
    }
  },
  created () {
    this.appId = this.$route.params.app_id;
    this.cateId = this.$route.params.cate_id;
    this.apiId = this.$route.params.api_id;
    this.ruleForm.app_id = this.appId;
    this.ruleForm.cate_id = this.cateId;
    this.getApiList(this.cateId);
    if (this.apiId != 0) {
      this.getOneApi(this.apiId);
    }
  },
  methods: {
    // 获取分类下的所有API列表
     getApiList (id) {
        // var url = this.$common.baseUrl + 'apis?app_id=' + this.appId + '&cate_id=' + this.cateId;
        var url = this.$common.baseUrl + '/apis?app_id=' + this.appId + '&cate_id=' + id;
        this.$http.get(url).then(function (res) {
            if (res.status !== 200) {
              this.$common.errorMsg(res.status)
              return false
            }
            this.lists = res.body;
            this.activeIndex = this.apiId + '';
        });
    },
    // 获取单个Api数据
    getOneApi(id){
      var url = this.$common.baseUrl + '/apis/' + id;
          this.$http.get(url).then(function (res) {
            if (res.status === 200) {
              this.ruleForm = res.body
            } else {
              this.$common.errorMsg(res.status)
            }
          })
    },
    submitForm (formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            // 如果APIID 为0，添加数据
            if (this.apiId == 0) {
              this.addApiData();
              return;
            }
            // 否则更新数据
            this.updateApiData(this.apiId);
          } else {
            this.$common.errorMsg('未输入有效信息');
            return false;
          }
        });
      },
      // 更新api数据
      updateApiData (id) {
        var url = this.$common.baseUrl + '/apis/' + id;
        this.$http.put(url, this.ruleForm, { emulateJSON: true }).then(function (res) {
          if(res.status !== 200){
              this.$common.errorMsg(res.status);
              return false;
          }
          this.$common.successMsg('更新Api成功');
          this.getApiList(this.cateId);
          this.apiTitle = this.ruleForm.name;
        })
      },
      // 点击添加API按钮
      addApi(){
        this.apiId = 0;
        this.resetForm('ruleForm')
      },
      // 添加API数据
    addApiData ( ) {
      var url = this.$common.baseUrl + '/apis';
      this.$http.post(url, this.ruleForm, { emulateJSON: true }).then(function (res) {
        if(res.status !== 200){
            this.$common.errorMsg(res.status);
            return false;
        }
        this.$common.successMsg('添加Api成功');
        this.getApiList(this.cateId);
        this.apiId = res.body.id;
        this.apiTitle = this.ruleForm.name;
      })
    },
    resetForm (formName) {
      this.ruleForm = {
          app_id: 0,
          cate_id: 0,
          name: '',
          description: '',
          method: 'GET',
          uri: '',
          req_header: '',
          req_body: '',
          resp_header: '',
          resp_body: '',
          remark: ''
      };
      this.ruleForm.cate_id = this.cateId;
      this.ruleForm.app_id = this.appId;
    },
    //  切换api信息
    sendApiInfo (title, id) {
      this.apiTitle = title;
      this.apiId = id;
      this.getOneApi(id);
    },
    // 删除api 信息
    deleteApiData () {
      var url = this.$common.baseUrl + '/apis/' + this.apiId;
      this.$http.delete(url).then(function (res) {
        if(res.status !== 200){
            this.$common.errorMsg(res.status);
            return false;
        }
        this.$common.successMsg('删除Api成功');
        this.resetForm();
        this.apiId = 0;
        this.getApiList(this.cateId);
      }, function (res) {
        this.$common.errorMsg(res.status);
      })
    },
    //进去request页面
    enterRequest () {
      var url = '/request/' + this.appId + '/' + this.cateId + '/' + this.apiId;
      this.$router.push(url);
    }
  }
}
</script>
<style scoped>

.grid-content.bg-purple-light{
    line-height: 36px;
}
.el-breadcrumb{
    line-height: inherit;
    /*display: inline-block;*/
}

</style>