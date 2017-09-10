<template>
    <div>
        <Row>
            <Col span="5">
                <div>
                    <Menu active-name="1">
                        <MenuItem v-bind="{name: index + 1}" v-for="(item,index) in apiList" :key="index" @click.native="switchApi(item.id)">
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
                        <Button icon="more" @click="makeRequest('formData', requestId)">请求</Button>
                        <Button icon="checkmark" @click="newRequest('formData')">另存</Button>
                        <Button icon="refresh" @click="editRequest('formData', requestId)">更新</Button>
                        <Button icon="android-delete" @click="deleteRequest(requestId)">删除</Button>
                    </ButtonGroup>
                     <Form ref="formData" :model="formData" :rules="ruleValidate" :label-width="80">
                        <FormItem label="基本信息">
                        </FormItem>
                        <FormItem label="名称" prop="name">
                            <Input v-model="formData.name" placeholder="请输入名称"></Input>
                        </FormItem>
                        <FormItem label="描述" prop="description">
                            <Input v-model="formData.description" placeholder="请输入描述"></Input>
                        </FormItem>
                        <FormItem label="环境" prop="env_id">
                            <Select v-model="formData.env_id" placeholder="dev">
                                <Option :value="item.id" v-for="item in envList" :key="item.id">dev</Option>
                            </Select>
                        </FormItem>
                        <FormItem label="请求">  
                        </FormItem>
                        <FormItem label="URL">
                            <Row type="flex" justify="start" class="code-row-bg"> 
                                <Col span="4">
                                    <Select v-model="formData.method" style="width:200px" placeholder="GET">
                                        <Option v-for="item in methodList" :value="item" :key="item">{{item}}</Option>
                                    </Select>
                                </Col>
                                <Col span="17" push="3">
                                    <Input v-model="formData.name" placeholder="请输入姓名"></Input>
                                </Col>
                            </Row>
                        </FormItem>
                        <FormItem label="请求头" prop="desc">
                            <Input v-model="formData.req_header" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="请求体" prop="desc">
                            <Input v-model="formData.req_body" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="响应">
                        </FormItem>
                        <FormItem label="响应头" prop="desc">
                            <Input v-model="formData.resp_header" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                        </FormItem>
                        <FormItem label="响应体" prop="desc">
                            <Tabs type="line">
                                <TabPane label="raw">{{formData.resp_body}}</TabPane>
                                <TabPane label="json">{{formData.resp_body_json}}</TabPane>
                            </Tabs>
                        </FormItem>
                        <FormItem label="备注" prop="remark">
                            <Input v-model="formData.name" placeholder="请输入备注"></Input>
                        </FormItem>
                        <FormItem>
                            <Button icon="more" @click="makeRequest('formData', requestId)">请求</Button>
                            <Button icon="checkmark"  @click="editRequest('formData')">另存</Button>
                        </FormItem>
                    </Form>
                </div>
            </Col>
            <Col span="5">
                <div>
                    <Menu active-name="1">
                        <MenuItem v-bind="{name: index + 1}" v-for="(item,index) in requestList" :key="index" @click.native="switchRequest(item.id)">
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
            //环境列表
            envList: [],
            // api列表
            apiList: [],
            //请求列表
            requestList: [],
            //http方法
            methodList: ['GET', 'POST', 'PUT', 'DELETE'],
            formData: {
                env_id: '',
                name: '',
                description: '',
                method: 'GET',
                uri: '',
                req_header: '',
                req_body: '',
                remark: '',
                resp_header: '',
                resp_body: ''
            },
            ruleValidate: {
                name: [
                    { required: true, message: '请输入名称', trigger: 'blur' },
                    { type: 'string', min: 2, message: '名称不能少于20字', trigger: 'blur' }
                ],
                description: [
                    { required: true, message: '请输入描述', trigger: 'blur' },
                    { type: 'string', min: 2, message: '描述不能少于20字', trigger: 'blur' }
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
        this.getRequestHistory(this.apiId);
        this.getEnvList(this.appId);
    },
    methods: {
        // 获取分类下的API列表
        getApiList () {
            let url = this.$common.baseUrl + '/apis?app_id=' + this.appId + '&cate_id=' + this.cateId;
            this.$http.get(url).then(function (res) {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.apiList = res.body;
            })
        },
        // 切换API
        switchApi (id) {
            this.handleReset('formData');
            let path = '/request/' + this.appId + '/' + this.cateId + '/' + id;
            this.$router.push(path);
            this.getOneRequest(id);
        },
        // 根据API 获取最近一条request 信息
        getOneRequest (id) {
            let url = this.$common.baseUrl + '/requests/api/' + id;
            this.$http.post(url, {}, { emulateJSON: true }).then(function (res) {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.formData = res.body;
                this.requestId = res.body.id;
            })
        },
        // 切换request详情
        switchRequest (id) {
            this.handleReset('formData');
            // 根据request id获取某个Request 详情 
            let url = this.$common.baseUrl + '/requests/' + id;
            this.$http.get(url).then(function (res) {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.formData = res.body;
                this.requestId = res.body.id;
            });
            console.log(id);
        },
        // 获取Api 的request历史
        getRequestHistory (id) {
            let url = this.$common.baseUrl + '/requests/api/' + id;
            this.$http.get(url).then((res) => {
                if (res.status !== 200) {
                  this.$common.errorMsg(res.status)
                  return false
                }
                this.requestList = res.body;
                // console.log(this.requestList);
            })
        },
        // 删除request
        deleteRequest (id) {
            let url = this.$common.baseUrl + '/requests/' + id;
            this.$http.delete(url).then(function (res) {
                if (res.body.id > 0) {
                    this.$common.successMsg('删除Request成功');
                }
            }).catch(() => {
                this.$common.errorMsg('删除Request失败');
            });
            // console.log(id);
        },
        // 获取环境列表
        getEnvList (id) {
            let url = this.$common.baseUrl + '/envs/app/' + id;
            this.$http.get(url).then((res) => {
                this.envList = res.body;
                console.log(this.envList);
            })
        },
        // 新增request
        newRequest (name) {
            this.$refs[name].validate((valid) => {
                if (valid) {
                    this.formData.api_id = this.apiId;
                    this.formData.app_id = this.appId;
                    this.formData.cate_id = this.cateId;
                    let url = this.$common.baseUrl + '/requests';
                    this.$http.post(url, this.formData, { emulateJSON: true }).then(function (res) {
                        if (res.body.id > 10) {
                            this.$common.successMsg('添加request成功');
                            return;
                        }
                        this.requestId = res.body.id;
                        this.getApiList();
                    }).catch(() => {
                        this.$common.errorMsg('添加Request失败');
                    });
                } else {
                    this.$Message.error('表单验证失败!');
                }
            });
            
        },
        // 更新request
        editRequest (name, id) {
            this.$refs[name].validate((valid) => {
                if (valid) {
                    let url = this.$common.baseUrl + '/requests/' + id;
                    this.$http.put(url,{
                        env_id: this.formData.env_id,
                        name: this.formData.name,
                        description: this.formData.description,
                        method: this.formData.method,
                        uri: this.formData.uri,
                        req_header: this.formData.req_header,
                        req_body: this.formData.req_body,
                        resp_header: this.formData.resp_header,
                        resp_body: this.formData.resp_body,
                        remark: this.formData.remark
                    }, { emulateJSON: true }).then((res) => {
                        if (res.status !== 200) {
                          this.$common.errorMsg(res.status)
                          return false
                        }
                        this.formData = res.body;
                        this.requestId = res.body.id;
                    }).catch(() => {
                        this.$common.errorMsg('更新Request失败');
                    })
            } else {
                    this.$Message.error('表单验证失败!');
                }
            });
        },
        makeRequest (name, id) {
            this.$refs[name].validate((valid) => {
                if (valid) {
                    let url = this.$common.baseUrl + '/requests/request' + id;
                    this.$http.post(url,{
                        app_id: this.appId,
                        cate_id: this.cateId,
                        api_id: this.apiId,
                        env_id: this.formData.env_id,
                        name: this.formData.name,
                        description: this.formData.description,
                        method: this.formData.method,
                        uri: this.formData.uri,
                        req_header: this.formData.req_header,
                        req_body: this.formData.req_body,
                        resp_header: this.formData.resp_header,
                        resp_body: this.formData.resp_body,
                        remark: this.formData.remark
                    }, { emulateJSON: true }).then((res) => {
                        if (res.status !== 200) {
                          this.$common.errorMsg(res.status)
                          return false
                        }
                        this.formData.resp_header = res.body.resp_header;
                        this.formData.resp_body = res.body.resp_body;
                        this.formData.resp_body_json = res.body.resp_body_json;
                    }).catch(() => {
                        this.$common.errorMsg('请求失败');
                    })
            } else {
                    this.$Message.error('表单验证失败!');
                }
            });
        },
        handleReset (name) {
            this.$refs[name].resetFields();
        }
    }
}
</script>
<style scoped>

</style>