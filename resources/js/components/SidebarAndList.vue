<template>
  <div>
    <el-container style="border: 1px solid #eee">
      <el-aside width="200px" style="background-color: rgb(238, 241, 246)">
        <el-menu
          default-active="1"
          class="el-menu-vertical-demo"
          @open="handleOpen"
          @close="handleClose"
          background-color="#374850"
          text-color="#fff"
          active-text-color="#ffd04b"
        >
          <router-link :to="{ name: 'indexAuthors'}">
            <el-menu-item index="2">
              <i class="fas fa-pen-alt hotpink"></i>
              <span slot="title" class="sidebar-padding">Authors</span>
            </el-menu-item>
          </router-link>
          <router-link :to="{ name: 'indexBooks'}">
            <el-menu-item index="3">
              <i class="fas fa-book-open mustard"></i>
              <span slot="title" class="sidebar-padding">Books</span>
            </el-menu-item>
          </router-link>
          <router-link :to="{ name: 'indexCategories'}">
            <el-menu-item index="4">
              <i class="fas fa-boxes powderblue"></i>
              <span slot="title" class="sidebar-padding">Categories</span>
            </el-menu-item>
          </router-link>
          <router-link :to="{ name: 'indexDepartments'}">
            <el-menu-item index="5">
              <i class="fas fa-building customgreen"></i>
              <span slot="title" class="sidebar-padding">Departments</span>
            </el-menu-item>
          </router-link>
          <router-link :to="{ name: 'indexUsers'}">
            <el-menu-item index="5">
              <i class="fas fa-users hotorange"></i>
              <span slot="title" class="sidebar-padding">Users</span>
            </el-menu-item>
          </router-link>
        </el-menu>
      </el-aside>
      <el-container>
        <el-header style="text-align: right; font-size: 12px">
          <el-dropdown>
            <i class="el-icon-setting" style="margin-right: 15px"></i>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>View</el-dropdown-item>
              <el-dropdown-item>Add</el-dropdown-item>
              <el-dropdown-item>Delete</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
          <span>Tom</span>
        </el-header>
        <el-main>
          <router-view></router-view>
        </el-main>
      </el-container>
    </el-container>
  </div>
</template>

<script>
export default {
  methods: {
    handleOpen(key, keyPath) {
      console.log(key, keyPath);
    },
    handleClose(key, keyPath) {
      console.log(key, keyPath);
    }
  }
};
</script>

<style>
.el-header {
  background-color: #b3c0d1;
  color: #333;
  line-height: 60px;
}
.el-aside {
  color: #333;
}
.sidebar-padding {
  padding-left: 10px;
}
.el-menu-item.is-active {
    background-color: #2c3a40 !important;
    color: white;
}
</style>
