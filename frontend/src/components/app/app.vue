<template>
    <div class="topHeight">
        <el-row type="flex" >
          <el-col :span="4">
            <div class="grid-content bg-purple">
              <el-menu default-active="2" class="el-menu-vertical-demo"  >
                      <el-menu-item index="1-1" v-for="(item,index) in lists" :key="index" @click="switchInfo(item.id)">{{item.name}}</el-menu-item>
                </el-menu>
              <el-button @click="dialogFormVisible = true" class="addAppDataButton">添加APP</el-button>
              <!-- Form -->
                <el-dialog title="添加APP" :visible.sync="dialogFormVisible">
                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                      <el-form-item label="名称" prop="name">
                        <el-input v-model="ruleForm.name"></el-input>
                      </el-form-item>
                      <el-form-item label="描述" prop="description">
                        <el-input v-model="ruleForm.description"></el-input>
                      </el-form-item>
                      <el-form-item label="备注" >
                        <el-input v-model="ruleForm.remark"></el-input>
                      </el-form-item>
                      <el-form-item>
                        <el-button @click="resetAppFrom('ruleForm')">重置</el-button>
                        <el-button type="primary" @click="submitAppForm('ruleForm')">提交</el-button>
                      </el-form-item>
                    </el-form>
                </el-dialog>
            </div>
          </el-col>
          <el-col :span="20" class="mainContent">
            <div class="grid-content bg-purple-light">
              <el-alert v-if="lists.length ===0"
                title="内容为空，请点击左侧的添加APP按钮"
                type="info">
              </el-alert>
              <div class="app-detail">
                <div class="app-info">
                  <div class="app-name">
                    <h2 class="app-name-header">{{detailInfo.name}}</h2>
                    <el-button-group>
                      <el-button icon="edit" size="small" @click="dialogFormVisible = true">编辑</el-button>
                      <!-- Form -->
                      <el-dialog title="编辑APP" :visible.sync="dialogFormVisible">
                          <el-form :model="detailInfo" :rules="rules" ref="detailInfo" label-width="100px" class="demo-ruleForm">
                            <el-form-item label="名称" prop="name">
                              <el-input v-model="detailInfo.name"></el-input>
                            </el-form-item>
                            <el-form-item label="描述" prop="description">
                              <el-input v-model="detailInfo.description"></el-input>
                            </el-form-item>
                            <el-form-item label="备注" >
                              <el-input v-model="detailInfo.remark"></el-input>
                            </el-form-item>
                            <el-form-item>
                              <el-button type="primary" @click="submitEditAppForm('detailInfo',detailInfo.id)">保存</el-button>
                            </el-form-item>
                          </el-form>
                      </el-dialog>
                      <el-button icon="delete" size="small" type="danger" @click="deleteAppData(detailInfo.id)">删除</el-button>
                    </el-button-group>
                  </div> 
                  <div class="app-desc">
                    <div class="app-name-header">APP 描述</div>
                    <div class="app-remark-detail">{{detailInfo.description}}</div>
                  </div>
                  <div class="app-remark" v-if="detailInfo.remark !== ''">
                    <div class="app-name-header">备注信息</div>
                    <div class="app-remark-detail">{{detailInfo.remark}}</div>
                  </div>
                  <div class="app-created">
                    <div class="app-name-header">创建时间</div>
                    <div class="app-remark-detail">{{detailInfo.created_at}}</div>
                  </div>
                </div>
                <div class="divider"></div>
                <div class="app-env">
                  <div>
                    <div class="app-env-header">
                      <div class="app-name-header">环境信息</div>
                      <el-button icon="plus" size="small" @click="dialogEnvFormVisible = true">添加环境</el-button>
                      <!-- Form -->
                      <el-dialog title="添加环境配置" :visible.sync="dialogEnvFormVisible">
                          <el-form :model="ruleEnvForm" :rules="EnvRules" ref="ruleEnvForm" label-width="100px" class="demo-ruleForm">
                            <el-form-item label="名称" prop="name">
                              <el-input v-model="ruleEnvForm.name"></el-input>
                            </el-form-item>
                            <el-form-item label="Url" prop="url">
                              <el-input v-model="ruleEnvForm.url"></el-input>
                            </el-form-item>
                            <el-form-item label="host" prop="host">
                              <el-input v-model="ruleEnvForm.host"></el-input>
                            </el-form-item>
                            <el-form-item label="颜色" >
                              <div class="block">
                                <el-color-picker v-model="ruleEnvForm.color"></el-color-picker>
                              </div>
                            </el-form-item>
                            <el-form-item label="备注" >
                              <el-input v-model="ruleEnvForm.remark"></el-input>
                            </el-form-item>
                            <el-form-item>
                              <el-button @click="resetEnvForm('ruleEnvForm')">重置</el-button>
                              <el-button type="primary" @click="submitEnvForm('ruleEnvForm')">提交</el-button>
                            </el-form-item>
                          </el-form>
                      </el-dialog>
                    </div>
                    <template>
                      <el-table
                        :data="envTableData"
                        border
                        fit
                        stripe
                        style="width: 95%">
                        <el-table-column
                          label="名称" width="150">
                          <template scope="scope">
                            <span>{{ scope.row.name}}</span>
                          </template>
                        </el-table-column>
                        <el-table-column
                          label="Url" min-width="200">
                          <template scope="scope">
                            <span>{{ scope.row.url}}</span>
                          </template>
                        </el-table-column>
                        <el-table-column
                          label="Host" min-width="200">
                          <template scope="scope">
                            <span>{{ scope.row.host}}</span>
                          </template>
                        </el-table-column>
                        <el-table-column
                          label="颜色" width="70" align="center">
                          <template scope="scope">
                            <div class="block">
                              <div class="app-show-color" :style="{'background-color':scope.row.color}"></div>
                            </div>
                          </template>
                        </el-table-column>
                        <el-table-column
                          label="备注" width="150">
                          <template scope="scope">
                            <span>{{ scope.row.remark}}</span>
                          </template>
                        </el-table-column>
                        <el-table-column label="操作" width="200">
                          <template scope="scope">
                            <el-button-group>
                              <el-button icon="edit" size="small" @click="startEditEnvData(scope.row)">编辑</el-button>
                              <el-button icon="delete" size="small" type="danger" @click="handleEnvDelete(scope.$index, ruleEnvForm.id)">删除</el-button>
                            </el-button-group>
                          </template>
                        </el-table-column>
                      </el-table>
                      <!-- Form -->
                              <el-dialog title="编辑环境配置" :visible.sync="dialogEnvFormVisible">
                                  <el-form :model="ruleEnvForm" :rules="EnvRules" ref="ruleEnvForm" label-width="100px" class="demo-ruleForm">
                                    <el-form-item label="名称" prop="name">
                                      <el-input v-model="ruleEnvForm.name"></el-input>
                                    </el-form-item>
                                    <el-form-item label="Url" prop="url">
                                      <el-input v-model="ruleEnvForm.url"></el-input>
                                    </el-form-item>
                                    <el-form-item label="host" prop="host">
                                      <el-input v-model="ruleEnvForm.host"></el-input>
                                    </el-form-item>
                                    <el-form-item label="颜色" >
                                      <div class="block">
                                        <el-color-picker v-model="ruleEnvForm.color"></el-color-picker>
                                      </div>
                                    </el-form-item>
                                    <el-form-item label="备注" >
                                      <el-input v-model="ruleEnvForm.remark"></el-input>
                                    </el-form-item>
                                    <el-form-item>
                                      <el-button @click="resetEnvForm('ruleEnvForm')">重置</el-button>
                                      <el-button type="primary" @click="submitEditEnvForm('ruleEnvForm', ruleEnvForm.id)">保存</el-button>
                                    </el-form-item>
                                  </el-form>
                              </el-dialog>
                    </template>
                  </div>
                </div>
                <div class="app-cate"></div>
              </div>
            </div>
          </el-col>
        </el-row>
    </div>
</template>

<script>
export default {
  data () {
    return {
      lists: [],
      httpStatus: 200,
      isInputEmpty: false,
      dialogFormVisible: false,
      dialogEnvFormVisible: false,
      currentAppID: 0,
      currentEnvId: 0,
      ruleForm: {
        name: '',
        description: '',
        remark: ''
      },
      rules: {
        name: [
          { required: true, message: '请输入名称', trigger: 'blur' },
          { min: 1, max: 50, message: '长度在 1 到 50 个字符', trigger: 'blur' }
        ],
        description: [
          { required: true, message: '请输入描述信息', trigger: 'blur' },
          { min: 1, max: 200, message: '长度在 1 到 200 个字符', trigger: 'blur' }
        ]
      },
      detailInfo: {},
      envTableData: [],
      EnvRules: {
        name: [
          { required: true, message: '请输入名称', trigger: 'blur' },
          { min: 1, max: 50, message: '长度在 1 到 50 个字符', trigger: 'blur' }
        ],
        url: [
          { required: true, message: '请输入url', trigger: 'blur' },
          { min: 1, max: 200, message: '长度在 1 到 200 个字符', trigger: 'blur' }
        ],
        host: [
          { required: true, message: '请输入url', trigger: 'blur' },
          { min: 1, max: 100, message: '长度在 1 到 200 个字符', trigger: 'blur' }
        ]
      },
      ruleEnvForm: {
        name: '',
        url: '',
        host: '',
        color: '#fff',
        remark: ''
      }
    }
  },
  mounted () {
    this.getAppLists()
  },
  methods: {
    getAppLists () {
      var url = 'http://rb.local.com/apps'
      this.$http.get(url).then(function (res) {
        if (res.status !== 200) {
          this.errotGetMsg()
          return false
        }
        var data = res.body || []
        this.httpStatus = res.status
        this.lists = data
        if (data[0]) {
          this.switchInfo(data[0].id)
        }
      })
    },
    errotGetMsg () {
      this.$message({
        showClose: true,
        message: this.httpStatus,
        type: 'error',
        duration: 3000
      })
    },
    successSubmitMsg ($msg) {
      $msg = $msg || '添加成功'
      this.$message({
        type: 'success',
        message: $msg
      })
    },
    submitAppForm (formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.dialogFormVisible = false
          this.addAppData()
        } else {
          return false
        }
      })
    },
    /* resetAppFrom () {
      this.ruleForm = {
        name: '',
        desc: '',
        remark: ''
      }
    }, */
    resetAppForm (formName) {
      this.$refs[formName].resetFields()
    },
    addAppData () {
      var url = 'http://rb.local.com/apps'
      this.$http.post(url, {name: this.ruleForm.name, description: this.ruleForm.description, remark: this.ruleForm.remark}, { emulateJSON: true }).then(function (res) {
        if (res.status === 200 && res.body.id) {
          this.successSubmitMsg()
          this.getAppLists()
        }
      })
      // this.resetAppFrom()
    },
    switchInfo (id) {
      this.currentAppID = id
      var url = 'http://rb.local.com/apps/' + id
      this.$http.get(url).then(function (res) {
        if (res.status === 200) {
          this.detailInfo = res.body
          this.getEnvData(id)
        } else {
          this.errotGetMsg()
        }
      })
    },
    getEnvData (id) {
      var url = 'http://rb.local.com/envs/app/' + id
      this.$http.get(url).then(function (res) {
        if (res.status === 200) {
          this.envTableData = res.body
        } else {
          this.errotGetMsg()
        }
      }, function () {
        this.envTableData = []
      })
    },
    /* resetEnvForm () {
      this.ruleEnvForm = {
        name: '',
        url: '',
        host: '',
        color: '#fff',
        remark: ''
      }
    }, */
    resetEnvForm (formName) {
      this.$refs[formName].resetFields()
    },
    submitEnvForm (formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.dialogEnvFormVisible = false
          this.addEnvData()
        } else {
          return false
        }
      })
    },
    addEnvData () {
      var url = 'http://rb.local.com/envs'
      this.$http.post(url, {name: this.ruleEnvForm.name, app_id: this.currentAppID, url: this.ruleEnvForm.url, remark: this.ruleEnvForm.remark, host: this.ruleEnvForm.host, color: this.ruleEnvForm.color}, { emulateJSON: true }).then(function (res) {
        if (res.status === 200 && res.body.id) {
          this.successSubmitMsg()
          this.getEnvData(this.currentAppID)
        }
      })
      // this.resetEnvForm()
    },
    successDeleteMsg () {
      this.$message({
        type: 'success',
        message: '删除成功'
      })
    },
    deleteAppData (id) {
      var url = 'http://rb.local.com/apps/' + id
      this.$http.delete(url).then(function (res) {
        if (res.status === 200 && res.body.id) {
          this.successDeleteMsg()
          this.getAppLists()
        }
      })
    },
    submitEditAppForm (formName, id) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.dialogFormVisible = false
          this.addEditAppData(id)
        } else {
          return false
        }
      })
    },
    addEditAppData (id) {
      var url = 'http://rb.local.com/apps/' + id
      this.$http.put(url, {name: this.detailInfo.name, description: this.detailInfo.description, remark: this.detailInfo.remark}, { emulateJSON: true }).then(function (res) {
        if (res.status === 200 && res.body.id) {
          this.successSubmitMsg('修改成功')
          this.getAppLists()
        }
      })
      // this.resetAppFrom()
    },
    handleEnvDelete (index, id) {
      var url = 'http://rb.local.com/envs/' + id
      this.$http.delete(url).then(function (res) {
        if (res.status === 200 && res.body.id) {
          this.successDeleteMsg()
          this.getEnvData(this.currentAppID)
        }
      })
    },
    submitEditEnvForm (formName, id) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.dialogEnvFormVisible = false
          this.addEditEnvData(id)
        } else {
          return false
        }
      })
    },
    addEditEnvData (id) {
      var url = 'http://rb.local.com/envs/' + id
      this.$http.put(url, {name: this.ruleEnvForm.name, app_id: this.currentAppID, url: this.ruleEnvForm.url, remark: this.ruleEnvForm.remark, host: this.ruleEnvForm.host, color: this.ruleEnvForm.color}, { emulateJSON: true }).then(function (res) {
        if (res.status === 200 && res.body.id) {
          this.successSubmitMsg('修改成功')
          this.getEnvData(this.currentAppID)
        }
      })
      // this.resetEnvForm()
    },
    startEditEnvData (row) {
      // console.log(row)
      for (var k in row) {
        this.ruleEnvForm[k] = row[k]
      }
      this.dialogEnvFormVisible = true
    }
  }
}
</script>
<style scoped>
.addAppDataButton{
  width: 100%;
}
.mainContent{
  padding-left: 10px;
}
.app-desc,.app-created{
  margin: 20px 0;
}
.app-remark-detail{
  margin: 5px 0;
}
.app-env-header{
  margin-bottom: 20px;
}
</style>