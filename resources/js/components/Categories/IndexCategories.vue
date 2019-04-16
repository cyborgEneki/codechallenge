<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="card-font">Categories</span>
        <router-link :to="{ name: 'addCategory' }">
          <i class="fas fa-plus-circle add-icon"></i>
        </router-link>
      </div>
      <table>
        <thead>
          <tr>
            <th width="90%">Name</th>
            <th class="actions-column">Options</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td width="90%">{{ category.name }}</td>
            <td>
              <i class="far fa-eye icon green"></i>
              <router-link :to="{ name: 'editCategory', params: { category } }">
                <i class="fas fa-edit icon blue"></i>
              </router-link>
              <i class="fas fa-trash-alt icon red"></i>
            </td>
          </tr>
        </tbody>
      </table>
      <router-view></router-view>
      <pagination :meta_data="meta_data" @next="getCategories"></pagination>
    </el-card>
  </div>
</template>

<script>
import Pagination from "../pagination";

export default {
  components: { Pagination },
  data() {
    return {
      categories: [],
      meta_data: {
        last_page: null,
        current_page: 1,
        prev_page_url: null
      }
    };
  },
  methods: {
    getCategories(page = 1) {
      axios
        .get("/api/categories/", {
          params: {
            page
          }
        })
        .then(res => {
          this.categories = res.data.data;
          this.meta_data.last_page = res.data.last_page;
          this.meta_data.current_page = res.data.current_page;
          this.meta_data.prev_page_url = res.data.prev_page_url;
        });
    }
  },
  created() {
    this.getCategories();
  }
};
</script>

<style>
</style>