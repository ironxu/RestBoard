<template>
    <div>
        <Row type="flex" justify="space-between">
            <Col span="5">
                <div>
                    <Menu active-name="1">
                        <MenuItem v-bind="{name: index + 1}" v-for="(item,index) in tableData" :key="index" @click.native="switchApi(item.id)">
                            {{item.name}}
                        </MenuItem>
                    </Menu>
                </div>
            </Col>
            <Col span="14">
                <div>
                    <Breadcrumb>
                        <BreadcrumbItem href="/">Home</BreadcrumbItem>
                        <BreadcrumbItem href="#">Components</BreadcrumbItem>
                    </Breadcrumb>
                    <ButtonGroup>
                        <Button icon="more">请求</Button>
                        <Button icon="checkmark">另存</Button>
                        <Button icon="refresh">更新</Button>
                        <Button icon="android-delete">删除</Button>
                    </ButtonGroup>
                     <Form ref="formValidate" :model="formValidate" :rules="ruleValidate" :label-width="80">
                        <FormItem label="基本信息">
                        </FormItem>
                        <FormItem label="名称" prop="name">
                            <Input v-model="formValidate.name" placeholder="请输入名称"></Input>
                        </FormItem>
                        <FormItem label="描述" prop="description">
                            <Input v-model="formValidate.description" placeholder="请输入描述"></Input>
                        </FormItem>
                        <FormItem label="环境" prop="env">
                            <Input v-model="formValidate.env" placeholder="请输入环境"></Input>
                        </FormItem>
                        <FormItem label="请求">  
                        </FormItem>
                        <FormItem label="URL">
                            <Row type="flex" justify="start" class="code-row-bg"> 
                                <Col span="4">
                                    <Select v-model="formValidate.method" style="width:200px" placeholder="GET">
                                        <Option v-for="item in methodList" :value="item" :key="item">{{item}}</Option>
                                    </Select>
                                </Col>
                                <Col span="17" push="3">
                                    <Input v-model="formValidate.name" placeholder="请输入姓名"></Input>
                                </Col>
                            </Row>
                        </FormItem>
                        <FormItem label="请求头" prop="desc">
                            <Input v-model="formValidate.req_header" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="请求体" prop="desc">
                            <Input v-model="formValidate.req_body" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="响应">
                        </FormItem>
                        <FormItem label="响应头" prop="desc">
                            <Input v-model="formValidate.resp_header" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="响应体" prop="desc">
                            <Tabs type="line">
                                <TabPane label="raw">{{formValidate.resp_body}}</TabPane>
                                <TabPane label="json">{{formValidate.resp_body_json}}</TabPane>
                            </Tabs>
                        </FormItem>
                        <FormItem label="备注" prop="name">
                            <Input v-model="formValidate.name" placeholder="请输入姓名"></Input>
                        </FormItem>
                        <FormItem>
                            <Button icon="more">请求</Button>
                            <Button icon="checkmark">另存</Button>
                        </FormItem>
                    </Form>
                </div>
            </Col>
            <Col span="5">
                <div>
                    <Menu active-name="1">
                        <MenuItem v-bind="{name: index + 1}" v-for="(item,index) in requestList" :key="index">
                            {{item.name}}
                        </MenuItem>
                    </Menu>
                </div>
            </Col>
        </Row>
    </div>
</template>

<script>
export default {
    data () {
        return {
            appId: 0,
            cateId: 0,
            apiId: 0,
            requestId: 0,
            tableData: [],
            //请求列表
            requestList: [],
            //http方法
            methodList: ['GET', 'POST', 'PUT', 'DELETE'],
            formValidate: {
                name: '',
                description: '',
                method: 'GET',
                uri: '',
                req_header: '',
                req_body: '',
                remark: '',
                resp_header: '',
                resp_body: '',
                resp_body_json: ''
            },
            ruleValidate: {
                description: [
                    { required: true, message: '请输入个人介绍', trigger: 'blur' },
                    { type: 'string', min: 20, message: '介绍不能少于20字', trigger: 'blur' }
                ]
            }
        }
    },
    created () {
        this.appId = this.$route.params.app_id;
        this.cateId = this.$route.params.cate_id;
        this.apiId = this.$route.params.api_id;
        this.getApiList();
        this.getOneRequest(this.apiId);
        this.getMoreRequest(this.apiId);
    },
    methods: {
        // 获取分类下的API列表
        getApiList () {
            var url = this.$common.baseUrl + '/apis?app_id=' + this.appId + '&cate_id=' + this.cateId;
            this.$http.get(url).then(function (res) {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.tableData = res.body;
            })
        },
        // 切换API
        switchApi (id) {
              
            this.getOneRequest(id);
            
        },
        // 获取单个request详情
        getOneRequest (id) {
            var url = this.$common.baseUrl + '/requests/' + id;
            this.$http.get(url).then(function (res) {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.formValidate = res.body;
            })
        },
        // 获取Api 的request历史
        getMoreRequest (id) {
            var url = this.$common.baseUrl + '/requests/api/' + id;
            this.$http.get(url).then((res) => {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.requestList = res.body;
                // console.log(this.requestList);
            })
        },
        handleSubmit (name) {
            this.$refs[name].validate((valid) => {
                if (valid) {
                    this.$Message.success('提交成功!');
                } else {
                    this.$Message.error('表单验证失败!');
                }
            })
        },
        handleReset (name) {
            this.$refs[name].resetFields();
        }
    }
}
</script>
<style scoped>

</style>