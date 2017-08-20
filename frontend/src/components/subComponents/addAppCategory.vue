<template>
    <el-dialog title="添加分类信息" :visible.sync="isShow">
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
      categoryRules: {}
    }
  },
  props: ['isShow'],
  watch: {
    isShow: function (now, old) {
      console.log(now, old)
    }
  }
}
</script>
<style scoped>

</style>