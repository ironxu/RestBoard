<template>
    <div>
        request
    </div>
</template>

<script>
export default {
    data () {
        return {
            appId: 0,
            cateId: 0,
            apiId: 0
        }
    },
    created () {
        this.appId = this.$route.params.app_id;
        this.cateId = this.$route.params.cate_id;
        this.apiId = this.$route.params.api_id;
    }
}
</script>
<style scoped>

</style>