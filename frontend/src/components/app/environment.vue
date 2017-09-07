<template>
    <div>
        <div>
            <div class="app-name-header other">环境信息</div>
            <el-button icon="plus" size="small" @click="addEnvData">添加环境</el-button>
        </div>
        <div>   
          <!-- Form -->
          <el-dialog :title="envTitle" :visible.sync="isShow">
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
              <el-form-item label="颜色">
                <div class="block">
                  <el-color-picker v-model="ruleEnvForm.color"></el-color-picker>
                </div>
              </el-form-item>
              <el-form-item label="备注">
                <el-input v-model="ruleEnvForm.remark"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button @click="isShow = false">取消</el-button>
                <el-button type="primary" @click="submitEnvForm('ruleEnvForm',ruleEnvForm.id)">保存</el-button>
              </el-form-item>
            </el-form>
          </el-dialog>
          <el-table :data="envTableData" border fit stripe style="width: 95%">
            <el-table-column label="名称" width="150">
              <template scope="scope">
                <span>{{ scope.row.name}}</span>
              </template>
            </el-table-column>
            <el-table-column label="Url" min-width="200">
              <template scope="scope">
                <span>{{ scope.row.url}}</span>
              </template>
            </el-table-column>
            <el-table-column label="Host" min-width="200">
              <template scope="scope">
                <span>{{ scope.row.host}}</span>
              </template>
            </el-table-column>
            <el-table-column label="颜色" width="70" align="center">
              <template scope="scope">
                <div class="block">
                  <div class="app-show-color" :style="{'background-color':scope.row.color}"></div>
                </div>
              </template>
            </el-table-column>
            <el-table-column label="备注" width="150">
              <template scope="scope">
                <span>{{ scope.row.remark}}</span>
              </template>
            </el-table-column>
            <el-table-column label="操作" width="200">
              <template scope="scope">
                <el-button-group>
                  <el-button icon="edit" size="small" @click="startEditEnvData(scope.row)">编辑</el-button>
                  <el-button icon="delete" size="small" @click="deleteEnvData(scope.$index, ruleEnvForm.id)">删除</el-button>
                </el-button-group>
              </template>
            </el-table-column>
          </el-table>
        </div>
    </div>
</template>
<script>
    export default{
        data () {
            return {
                id:0,
                envTitle:'添加环境配置',
                envTableData:[],
                isShow:false,
                  // 环境信息表单验证
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
        props:['appId'],
        methods: {
            // 添加环境信息
            addEnvData () {
              this.envTitle = '添加环境配置';
              this.resetEnvForm();
              this.isShow = true;
            },
            // 重置环境信息表单
            resetEnvForm () {
              // this.$refs[formName].resetFields()
              this.ruleEnvForm = {
                    name: '',
                    url: '',
                    host: '',
                    color: '#fff',
                    remark: ''
                  }
            },
            // 提交环境配置表单
            submitEnvForm (formName,id) {
              this.$refs[formName].validate((valid) => {
                if (valid) {
                  this.isShow = false
                  if(this.envTitle === '添加环境配置'){
                      var url = this.$common.baseUrl + '/envs';

                      this.$http.post(url, { name: this.ruleEnvForm.name, app_id: this.appId, url: this.ruleEnvForm.url, remark: this.ruleEnvForm.remark, host: this.ruleEnvForm.host, color: this.ruleEnvForm.color }, { emulateJSON: true }).then(function (res) {
                        if (res.status === 200 && res.body.id) {
                          this.$common.successMsg('添加环境成功')
                          this.getEnvData(this.appId)
                          return false
                        }
                        this.$common.errorMsg(res.status)
                      })
                      this.resetEnvForm();
                  } else {
                      var url = this.$common.baseUrl + '/envs/' + id
                      this.$http.put(url, { name: this.ruleEnvForm.name, app_id: this.appId, url: this.ruleEnvForm.url, remark: this.ruleEnvForm.remark, host: this.ruleEnvForm.host, color: this.ruleEnvForm.color }, { emulateJSON: true }).then(function (res) {
                        if (res.status === 200 && res.body.id) {
                          this.$common.successMsg('修改环境成功')
                          this.getEnvData(this.appId)
                          return
                        }
                        this.$common.errorMsg(res.status)
                      })
                  }
                } else {
                  this.$common.errorMsg('提交环境信息失败')
                  return false
                }
              })
            },
            // 删除环境配置信息
            deleteEnvData (index, id) {
              var url = this.$common.baseUrl + '/envs/' + id
              this.$http.delete(url).then(function (res) {
                if (res.status === 200 && res.body.id) {
                  this.$common.successMsg('删除环境信息成功')
                  // this.getEnvData(this.appId)
                  return
                }
                this.$common.errorMsg(res.status)
              })
            },
            // 启动编辑环境信息
            startEditEnvData (row) {
              this.envTitle = "编辑环境配置"
              // console.log(row)
              for (var k in row) {
                this.ruleEnvForm[k] = row[k]
              }
              this.isShow = true
            },
            //  获取环境配置信息
            getEnvData (id) {
              var url = this.$common.baseUrl + '/envs/app/' + id;
              this.$http.get(url).then(function (res) {
                if (res.status === 200) {
                  this.envTableData = res.body
                } else {
                  this.$common.errorMsg(res.status)
                }
              }, function (res) {
                this.envTableData = []
                this.$common.errorMsg(res.status)
              })
            }
        }
    }
</script>
<style scoped>
.app-name-header.other{
    margin-bottom: 20px;
}
</style>