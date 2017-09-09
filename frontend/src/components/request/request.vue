<template>
    <div>
        <Row :gutter="136">
            <Col span="4">
                <div>
                    <Menu active-name="1">
                        <MenuItem :name="index" v-for="(item,index) in tableData" :key="index">
                            {{item.name}}
                        </MenuItem>
                    </Menu>
                </div>
            </Col>
            <Col span="20">
                <div>
                    <Breadcrumb>
                        <BreadcrumbItem href="/">Home</BreadcrumbItem>
                        <BreadcrumbItem href="#">Components</BreadcrumbItem>
                    </Breadcrumb>
                    <ButtonGroup>
                        <Button type="error" icon="more">请求</Button>
                        <Button icon="checkmark">另存</Button>
                        <Button type="error" icon="refresh">更新</Button>
                        <Button icon="android-delete">删除</Button>
                    </ButtonGroup>
                </div>
                <div>
                     <Form ref="formValidate" :model="formValidate" :rules="ruleValidate" :label-width="80">
                        <FormItem label="基本信息">
                            
                        </FormItem>
                        <FormItem label="名称" prop="name">
                            <Input v-model="formValidate.name" placeholder="请输入姓名"></Input>
                        </FormItem>
                        <FormItem label="描述" prop="description">
                            <Input v-model="formValidate.description" placeholder="请输入姓名"></Input>
                        </FormItem>
                        <FormItem label="环境" prop="env">
                            <Input v-model="formValidate.env" placeholder="请输入姓名"></Input>
                        </FormItem>
                        <FormItem label="请求">
                            
                        </FormItem>
                        <FormItem>
                            <Row>
                                <Col span="12">
                                    <Select v-model="formValidate.method" style="width:200px" placeholder="GET">
                                        <Option v-for="item in methodList" :value="item" :key="item">{{item}}</Option>
                                    </Select>
                                </Col>
                                <Col span="12">
                                    <Input v-model="formValidate.name" placeholder="请输入姓名"></Input>
                                </Col>
                            </Row>
                        </FormItem>
                        <FormItem label="请求头" prop="desc">
                            <Input v-model="formValidate.desc" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="请求体" prop="desc">
                            <Input v-model="formValidate.desc" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="响应">
                            
                        </FormItem>
                        <FormItem label="响应头" prop="desc">
                            <Input v-model="formValidate.desc" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="响应体" prop="desc">
                            <Tabs type="line">
                                <TabPane label="raw">raw</TabPane>
                                <TabPane label="json">json</TabPane>

                            </Tabs>
                        </FormItem>
                        <FormItem label="备注" prop="name">
                            <Input v-model="formValidate.name" placeholder="请输入姓名"></Input>
                        </FormItem>
                        <FormItem>
                            <Button type="primary" @click="handleSubmit('formValidate')">提交</Button>
                            <Button type="ghost" @click="handleReset('formValidate')" style="margin-left: 8px">重置</Button>
                        </FormItem>
                    </Form>
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
            tableData: [],
            //http方法
            methodList: ['GET', 'POST', 'PUT', 'DELETE'],
            formValidate: {
                    name: '',
                    mail: '',
                    city: '',
                    gender: '',
                    interest: [],
                    date: '',
                    time: '',
                    desc: ''
                },
            ruleValidate: {
                name: [
                    { required: true, message: '姓名不能为空', trigger: 'blur' }
                ],
                mail: [
                    { required: true, message: '邮箱不能为空', trigger: 'blur' },
                    { type: 'email', message: '邮箱格式不正确', trigger: 'blur' }
                ],
                city: [
                    { required: true, message: '请选择城市', trigger: 'change' }
                ],
                gender: [
                    { required: true, message: '请选择性别', trigger: 'change' }
                ],
                interest: [
                    { required: true, type: 'array', min: 1, message: '至少选择一个爱好', trigger: 'change' },
                    { type: 'array', max: 2, message: '最多选择两个爱好', trigger: 'change' }
                ],
                date: [
                    { required: true, type: 'date', message: '请选择日期', trigger: 'change' }
                ],
                time: [
                    { required: true, type: 'date', message: '请选择时间', trigger: 'change' }
                ],
                desc: [
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