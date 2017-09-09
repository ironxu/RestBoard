<template>
<div>
    <div class="app-name-header">分类信息</div>
    <el-button icon="plus" size="small" @click="addCategory">添加分类</el-button>
    <el-dialog :title="categoryTitle" :visible.sync="isShow">
        <el-form :model="categoryForm" :rules="categoryRules" ref="categoryForm" label-width="100px" class="demo-ruleForm">
            <el-form-item label="名称" prop="name">
                <el-input v-model.trim="categoryForm.name"></el-input>
            </el-form-item>
            <el-form-item label="上级">
                <el-cascader
                    :options="options"
                    v-model="categoryForm.pid"
                    placeholder="顶级分类"
                    @change="handleChange">
                </el-cascader>
                <!-- <el-input v-model="categoryForm.pid"></el-input> -->
            </el-form-item>
            <el-form-item label="排序" prop="sort">
                <el-input v-model.number="categoryForm.sort"></el-input>
            </el-form-item>
            <el-form-item label="备注">
                <el-input v-model="categoryForm.remark"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button @click="isShow = false">取消</el-button>
                <el-button type="primary" @click="submitEditCategoryForm('categoryForm', categoryForm.id)">保存</el-button>
            </el-form-item>
        </el-form>
    </el-dialog>
</div>
</template>
<script>
export default {
  data () {
    return {
      isShow:false,
      treeId:0,
      categoryTitle:'添加分类信息',
      categoryForm: {
        name: '',
        sort: 0,
        remark: ''
      },
      // 分类表单验证
      categoryRules: {
        name: [
          { required: true, message: '请输入名称', trigger: 'blur' },
          { min: 1, max: 50, message: '长度在 1 到 50 个字符', trigger: 'blur' }
        ]
      },
      options: []
    }
  },
  props:['appId','cateId'],
  created(){
    this.getCascader();
  },
  methods:{
    // 获取分类表单信息
    getCategoryForm(id){
      var url = this.$common.baseUrl + '/categories/' + id;
      this.$http.get(url).then(function (res) {
        if ( res.status !== 200) {
          this.$common.errorMsg(res.status);
          return false;
        }
        // this.categoryForm
        var temp = res.body;
        this.treeId = temp.id;
        this.categoryForm.name = temp.name;
        this.categoryForm.pid = temp.path;
        this.categoryForm.sort = temp.sort || 0;
        this.categoryForm.remark = temp.remark || '';
        this.categoryTitle = '编辑分类信息';
        this.isShow = true;
      })
    },
    // 添加分类信息
    addCategory(){
      this.categoryTitle = '添加分类信息';
      this.resetForm();
      this.isShow = true;
    },
    // 获取级联数据
    getCascader(){
      var url = this.$common.baseUrl  + '/categories/app/' + this.appId + '?type=cascader'
      this.$http.get(url).then(function (res) {
        //// console.log(res.body)
        if(res.status !== 200){
          this.$common.errorMsg(res.status);
          return;
        }
        this.options = res.body;
      })
    },
    handleChange (t) {
      // console.log(t)
    },
    resetForm () {
      this.categoryForm = {
        name: '',
        sort: 0,
        remark: ''
      }
    },
    submitEditCategoryForm (formName,id) {
      var pid = 0;
      this.$refs[formName].validate((valid) => {
        if (valid) {
          var temp = this.categoryForm.pid;
          if (temp && temp.length !== 0) {
              pid = temp[temp.length - 1];
          }
          if (this.categoryTitle == '添加分类信息') {
            //添加信息
            var url = this.$common.baseUrl + '/categories';
            this.$http.post(url, {
              app_id: this.appId,
              name: this.categoryForm.name,
              pid: pid,
              sort: this.categoryForm.sort,
              remark: this.categoryForm.remark
            }, { emulateJSON: true }).then(function (res) {
              if(res.status !== 200){
                this.$common.errorMsg(res.status);
                return false;
              }
              this.$common.successMsg('添加分类成功');
              this.refreshCategory();
            })
          } else {
            // 修改分类信息
            var url = this.$common.baseUrl + '/categories/' + this.treeId;
            this.$http.put(url,{
              name: this.categoryForm.name,
              pid: pid,
              sort: this.categoryForm.sort,
              remark: this.categoryForm.remark
            }, { emulateJSON: true }).then(function (res) {
              if(res.status !== 200){
                this.$common.errorMsg(res.status);
                return false;
              }
              this.$common.successMsg('修改分类成功');
              this.refreshCategory();
            }) 
          }
        } else {
          this.$common.errorMsg('提交分类失败')
          return false
        }
      })
      this.isShow = false
    },
    refreshCategory(){
      this.$emit('refreshCate');
    }
  }
}
</script>
<style scoped>

</style>