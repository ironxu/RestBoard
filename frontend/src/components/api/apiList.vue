<template>
    <div>
        <el-row>
          <el-col :span="4">
            <div class="grid-content bg-purple">
              <el-tree
                  :data="lists"
                  :props="defaultProps"
                  accordion
                  default-expand-all
                  :highlight-current="true"
                  @node-click="handleNodeClick">
             </el-tree>
            </div>
          </el-col>
          <el-col :span="20"  class="mainContent">
            <div class="grid-content bg-purple-light">
                <el-breadcrumb separator="/">
                  <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                  <el-breadcrumb-item>{{appData.name}}</el-breadcrumb-item>
                  <!-- <el-breadcrumb-item>{{}}</el-breadcrumb-item> -->
                </el-breadcrumb>
                <router-link v-bind="{to:'/api/detail/' + appId + '/' + cateId + '/' + 0}"><el-button size="small">新增Api</el-button></router-link>
                  <el-table
                    :data="tableData"
                    border
                    style="width: 100%">
                    <el-table-column
                      label="名称"
                      width="180">
                      <template scope="scope">
                        <span>{{ scope.row.name }}</span>
                      </template>
                    </el-table-column>
                    <el-table-column
                      label="方法"
                      width="180">
                      <template scope="scope">
                        <span>{{ scope.row.method }}</span>
                      </template>
                    </el-table-column>
                    <el-table-column
                      label="URL"
                      width="180">
                      <template scope="scope">
                        
                        <span>{{ scope.row.uri }}</span>
                      </template>
                    </el-table-column>
                    <el-table-column
                      label="备注"
                      width="180">
                      <template scope="scope">
                        
                        <span>{{ scope.row.remark }}</span>
                      </template>
                    </el-table-column>
                    <el-table-column
                      label="修改时间"
                      width="200">
                      <template scope="scope">
                        <span>{{ scope.row.updated_at }}</span>
                      </template>
                    </el-table-column>
                    <el-table-column label="操作">
                      <template scope="scope">
                        <router-link v-bind="{to:'/api/detail/' + appId + '/' + cateId + '/' + scope.row.id}"><el-button size="small">编辑</el-button></router-link>
                        <el-button
                          size="small"
                          type="danger"
                          @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                      </template>
                    </el-table-column>
                  </el-table>
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
            defaultProps: {
              children: 'children',
              label: 'name'
            },
            appId: 0,
            cateId:0,
            appData: {},
            // 表格数据
            tableData: []
        }
    },
    created () {
        this.appId = this.$route.params.app_id;
        // console.log(this.appId)
        this.cateId = this.$route.params.cate_id;
        // console.log(this.cateId);
        // console.log(this.$route.params)
        this.getAllCategory(this.appId);
        this.getOneApp();

        this.getApiList();
    },
    methods: {
        // 获取所有分类
        getAllCategory (id) {
            var url = this.$common.baseUrl + '/categories/app/' + id;
            this.$http.get(url).then(function (res) {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.lists = res.body;
                // console.log(this.lists);
            })

        },
        handleNodeClick(data) {
            // console.log(data.id);
            this.cateId = data.id;
            this.getApiList();
         },
         // 获取分类下的API列表
         getApiList () {
            var url = this.$common.baseUrl + '/apis?app_id=' + this.appId + '&cate_id=' + this.cateId;
            // var url = this.$common.baseUrl + '/apis?app_id=' + this.appId + '&cate_id=' + 2;
            // console.log(url);
            this.$http.get(url).then(function (res) {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.tableData = res.body;
            })
        },
         // 获取一个APP的信息
         getOneApp () {
          var url = this.$common.baseUrl + '/apps/' + this.appId
          this.$http.get(url).then(function (res) {
            if (res.status === 200) {
              this.appData = res.body
              // console.log(this.appData)
            } else {
              this.$common.errorMsg(res.status)
            }
          })
        },
        // 表格编辑
         handleEdit(index, row) {
            // console.log(index, row);
          },
        // 删除表格
          handleDelete(index, row) {
            // console.log(index, row);
          }
    }
}
</script>
<style scoped>

/* .el-col {
  border-radius: 4px;
}

.bg-purple-dark {
  background: #99a9bf;
}

.bg-purple {
  background: #d3dce6;
}

.bg-purple-light {
  background: #e5e9f2;
}

.grid-content {
  border-radius: 4px;
  min-height: 36px;
} */

.grid-content.bg-purple-light{
    line-height: 36px;
}
.el-breadcrumb{
    line-height: inherit;
    /*display: inline-block;*/
}
</style>