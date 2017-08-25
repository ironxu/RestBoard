<template>
    <el-dialog title="添加分类信息" :visible="isShow">
        <el-form :model="categoryForm" :rules="categoryRules" ref="categoryForm" label-width="100px" class="demo-ruleForm">
            <el-form-item label="名称" prop="name">
                <el-input v-model="categoryForm.name"></el-input>
            </el-form-item>
            <el-form-item label="上级" prop="pid">
                <el-cascader
                    :options="options"
                    v-model="categoryForm.pid"
                    @change="handleChange">
                </el-cascader>
                <!-- <el-input v-model="categoryForm.pid"></el-input> -->
            </el-form-item>
            <el-form-item label="排序" prop="sort">
                <el-input v-model="categoryForm.sort"></el-input>
            </el-form-item>
            <el-form-item label="备注">
                <el-input v-model="categoryForm.remark"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button @click="resetCategoryForm('categoryForm')">重置</el-button>
                <el-button type="primary" @click="submitEditCategoryForm('categoryForm', categoryForm.id)">保存</el-button>
            </el-form-item>
        </el-form>
    </el-dialog>
</template>
<script>
export default {
  data () {
    return {
      categoryForm: {},
      categoryRules: {},
      options: []
    }
  },
  props: ['isShow'],
  created(){
    this.getCascader();
  },
  methods:{
    // 获取级联数据
    getCascader(){
      var url = this.$common.baseUrl  + '/categories/app/4?type=cascader'
      this.$http.get(url).then(function (res) {
        // console.log(res.body)
        if(res.status !== 200){
          this.$common.errorMsg(res.status);
          return;
        }

        this.options = res.body;
      })
    },
    handleChange(){
      console.log(1);
    },
    resetCategoryForm(formName){

    },
    submitEditCategoryForm(formName,id){

    }
  }
}
</script>
<style scoped>

</style>