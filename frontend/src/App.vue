<template>
  <div>
	<!-- element-ui navMenu -->
	<el-menu theme="dark" :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect" :router=true>
	  <el-menu-item index="home">RestBoard</el-menu-item>
	  <el-menu-item index="/app">
	    App
	  </el-menu-item>
      <el-menu-item>Api</el-menu-item>
      <el-menu-item>Request</el-menu-item>
      <el-menu-item>Doc</el-menu-item>

	  <!-- <el-menu-item index="/api/list">Api</el-menu-item>
      <el-menu-item index="/request">Request</el-menu-item>
      <el-menu-item index="/doc">Doc</el-menu-item> -->
	</el-menu>
	<!-- 占位符 -->
	<router-view></router-view>
	
  </div>
</template>

<script>
export default {
  data () {
    return {
      activeIndex: 'home'
    }
  },
  methods: {
    handleSelect (key, keyPath) {
      // console.log(key, keyPath)
    }
  }
}
</script>

<style scoped>

</style>
